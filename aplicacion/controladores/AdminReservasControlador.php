<?php
class AdminReservasControlador
{
    private $db;

    public function __construct()
    {
        $this->db = BaseDatos::conectar();
    }

    // Listar todas las reservas
    public function index()
    {
        $titulo = "Gestión de Reservas";

        // Obtener filtros
        $fecha_desde = $_GET['fecha_desde'] ?? '';
        $fecha_hasta = $_GET['fecha_hasta'] ?? '';
        $experiencia_id = $_GET['experiencia_id'] ?? '';
        $estado = $_GET['estado'] ?? '';
        $busqueda = $_GET['busqueda'] ?? '';

        // Construir query
        $sql = "SELECT r.*, e.nombre as experiencia_nombre, u.usuario as usuario_nombre
                FROM reservas r
                LEFT JOIN experiencias e ON r.experiencia_id = e.id
                LEFT JOIN usuarios u ON r.usuario_id = u.id
                WHERE 1=1";
        $params = [];

        if ($fecha_desde) {
            $sql .= " AND r.fecha_reserva >= :fecha_desde";
            $params[':fecha_desde'] = $fecha_desde;
        }

        if ($fecha_hasta) {
            $sql .= " AND r.fecha_reserva <= :fecha_hasta";
            $params[':fecha_hasta'] = $fecha_hasta;
        }

        if ($experiencia_id) {
            $sql .= " AND r.experiencia_id = :experiencia_id";
            $params[':experiencia_id'] = $experiencia_id;
        }

        if ($estado) {
            $sql .= " AND r.estado_pago = :estado";
            $params[':estado'] = $estado;
        }

        if ($busqueda) {
            $sql .= " AND (r.codigo_confirmacion LIKE :busqueda OR r.nombre LIKE :busqueda OR r.email LIKE :busqueda)";
            $params[':busqueda'] = '%' . $busqueda . '%';
        }

        $sql .= " ORDER BY r.fecha_creacion DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Obtener experiencias para filtro
        $sqlExp = "SELECT id, nombre FROM experiencias ORDER BY nombre";
        $stmtExp = $this->db->query($sqlExp);
        $experiencias = $stmtExp->fetchAll(PDO::FETCH_ASSOC);

        require_once RUTA_VISTAS . 'admin/plantillas/encabezado.php';
        require_once RUTA_VISTAS . 'admin/plantillas/sidebar.php';
        require_once RUTA_VISTAS . 'admin/reservas/index.php';
        require_once RUTA_VISTAS . 'admin/plantillas/pie.php';
    }

    // Ver detalle de reserva
    public function ver()
    {
        $id = $_GET['id'] ?? 0;
        $titulo = "Detalle de Reserva";

        $sql = "SELECT r.*, e.nombre as experiencia_nombre, e.region, e.precio as precio_unitario,
                       u.usuario as usuario_nombre, u.email as usuario_email, u.telefono as usuario_telefono
                FROM reservas r
                LEFT JOIN experiencias e ON r.experiencia_id = e.id
                LEFT JOIN usuarios u ON r.usuario_id = u.id
                WHERE r.id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        $reserva = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$reserva) {
            $_SESSION['mensaje'] = 'Reserva no encontrada';
            $_SESSION['tipo_mensaje'] = 'error';
            header('Location: admin.php?module=reservas');
            exit;
        }

        require_once RUTA_VISTAS . 'admin/plantillas/encabezado.php';
        require_once RUTA_VISTAS . 'admin/plantillas/sidebar.php';
        require_once RUTA_VISTAS . 'admin/reservas/ver.php';
        require_once RUTA_VISTAS . 'admin/plantillas/pie.php';
    }

    // Cambiar estado de pago
    public function cambiarEstado()
    {
        $id = $_GET['id'] ?? 0;
        $estado = $_GET['estado'] ?? '';

        if (!in_array($estado, ['pendiente', 'confirmado', 'cancelado'])) {
            $_SESSION['mensaje'] = 'Estado no válido';
            $_SESSION['tipo_mensaje'] = 'error';
            header('Location: admin.php?module=reservas');
            exit;
        }

        try {
            $sql = "UPDATE reservas SET estado_pago = :estado WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':estado' => $estado, ':id' => $id]);

            $_SESSION['mensaje'] = 'Estado actualizado exitosamente';
            $_SESSION['tipo_mensaje'] = 'success';

        } catch (PDOException $e) {
            $_SESSION['mensaje'] = 'Error al actualizar estado: ' . $e->getMessage();
            $_SESSION['tipo_mensaje'] = 'error';
        }

        header('Location: admin.php?module=reservas&action=ver&id=' . $id);
        exit;
    }

    // Cancelar reserva
    public function cancelar()
    {
        $id = $_GET['id'] ?? 0;

        try {
            $sql = "UPDATE reservas SET estado_pago = 'cancelado' WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $id]);

            $_SESSION['mensaje'] = 'Reserva cancelada exitosamente';
            $_SESSION['tipo_mensaje'] = 'success';

        } catch (PDOException $e) {
            $_SESSION['mensaje'] = 'Error al cancelar reserva: ' . $e->getMessage();
            $_SESSION['tipo_mensaje'] = 'error';
        }

        header('Location: admin.php?module=reservas');
        exit;
    }

    // Exportar a CSV
    public function exportar()
    {
        // Obtener reservas con los mismos filtros
        $fecha_desde = $_GET['fecha_desde'] ?? '';
        $fecha_hasta = $_GET['fecha_hasta'] ?? '';

        $sql = "SELECT r.codigo_confirmacion, r.nombre, r.email, r.telefono, 
                       e.nombre as experiencia, r.fecha_reserva, r.hora_reserva, 
                       r.num_personas, r.monto_total, r.estado_pago, r.fecha_creacion
                FROM reservas r
                LEFT JOIN experiencias e ON r.experiencia_id = e.id
                WHERE 1=1";
        $params = [];

        if ($fecha_desde) {
            $sql .= " AND r.fecha_reserva >= :fecha_desde";
            $params[':fecha_desde'] = $fecha_desde;
        }

        if ($fecha_hasta) {
            $sql .= " AND r.fecha_reserva <= :fecha_hasta";
            $params[':fecha_hasta'] = $fecha_hasta;
        }

        $sql .= " ORDER BY r.fecha_creacion DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Generar CSV
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=reservas_' . date('Y-m-d') . '.csv');

        $output = fopen('php://output', 'w');

        // Encabezados
        fputcsv($output, ['Código', 'Nombre', 'Email', 'Teléfono', 'Experiencia', 'Fecha', 'Hora', 'Personas', 'Monto', 'Estado', 'Creado']);

        // Datos
        foreach ($reservas as $reserva) {
            fputcsv($output, [
                $reserva['codigo_confirmacion'],
                $reserva['nombre'],
                $reserva['email'],
                $reserva['telefono'],
                $reserva['experiencia'],
                $reserva['fecha_reserva'],
                $reserva['hora_reserva'],
                $reserva['num_personas'],
                $reserva['monto_total'],
                $reserva['estado_pago'],
                $reserva['fecha_creacion']
            ]);
        }

        fclose($output);
        exit;
    }
}
?>