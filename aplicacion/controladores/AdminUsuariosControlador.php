<?php
class AdminUsuariosControlador
{
    private $db;

    public function __construct()
    {
        $this->db = BaseDatos::conectar();
    }

    // Listar todos los usuarios
    public function index()
    {
        $titulo = "Gestión de Usuarios";

        // Obtener filtros
        $rol = $_GET['rol'] ?? '';
        $busqueda = $_GET['busqueda'] ?? '';

        // Construir query
        $sql = "SELECT u.*, COUNT(r.id) as total_reservas
                FROM usuarios u
                LEFT JOIN reservas r ON u.id = r.usuario_id
                WHERE 1=1";
        $params = [];

        if ($rol) {
            $sql .= " AND u.rol = :rol";
            $params[':rol'] = $rol;
        }

        if ($busqueda) {
            $sql .= " AND (u.usuario LIKE :busqueda OR u.email LIKE :busqueda)";
            $params[':busqueda'] = '%' . $busqueda . '%';
        }

        $sql .= " GROUP BY u.id ORDER BY u.fecha_registro DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require_once RUTA_VISTAS . 'admin/plantillas/encabezado.php';
        require_once RUTA_VISTAS . 'admin/plantillas/sidebar.php';
        require_once RUTA_VISTAS . 'admin/usuarios/index.php';
        require_once RUTA_VISTAS . 'admin/plantillas/pie.php';
    }

    // Cambiar rol de usuario
    public function cambiarRol()
    {
        $id = $_GET['id'] ?? 0;
        $nuevoRol = $_GET['rol'] ?? '';

        if (!in_array($nuevoRol, ['usuario', 'admin'])) {
            $_SESSION['mensaje'] = 'Rol no válido';
            $_SESSION['tipo_mensaje'] = 'error';
            header('Location: admin.php?module=usuarios');
            exit;
        }

        // No permitir cambiar el propio rol
        if ($id == $_SESSION['usuario_id']) {
            $_SESSION['mensaje'] = 'No puedes cambiar tu propio rol';
            $_SESSION['tipo_mensaje'] = 'error';
            header('Location: admin.php?module=usuarios');
            exit;
        }

        try {
            $sql = "UPDATE usuarios SET rol = :rol WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':rol' => $nuevoRol, ':id' => $id]);

            $_SESSION['mensaje'] = 'Rol actualizado exitosamente';
            $_SESSION['tipo_mensaje'] = 'success';

        } catch (PDOException $e) {
            $_SESSION['mensaje'] = 'Error al actualizar rol: ' . $e->getMessage();
            $_SESSION['tipo_mensaje'] = 'error';
        }

        header('Location: admin.php?module=usuarios');
        exit;
    }

    // Toggle activar/desactivar usuario
    public function toggle()
    {
        $id = $_GET['id'] ?? 0;

        // No permitir desactivar el propio usuario
        if ($id == $_SESSION['usuario_id']) {
            $_SESSION['mensaje'] = 'No puedes desactivar tu propia cuenta';
            $_SESSION['tipo_mensaje'] = 'error';
            header('Location: admin.php?module=usuarios');
            exit;
        }

        try {
            $sql = "UPDATE usuarios SET activo = NOT activo WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $id]);

            $_SESSION['mensaje'] = 'Estado actualizado exitosamente';
            $_SESSION['tipo_mensaje'] = 'success';

        } catch (PDOException $e) {
            $_SESSION['mensaje'] = 'Error al actualizar estado: ' . $e->getMessage();
            $_SESSION['tipo_mensaje'] = 'error';
        }

        header('Location: admin.php?module=usuarios');
        exit;
    }

    // Ver historial de reservas del usuario
    public function historial()
    {
        $id = $_GET['id'] ?? 0;
        $titulo = "Historial de Reservas";

        // Obtener usuario
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$usuario) {
            $_SESSION['mensaje'] = 'Usuario no encontrado';
            $_SESSION['tipo_mensaje'] = 'error';
            header('Location: admin.php?module=usuarios');
            exit;
        }

        // Obtener reservas
        $sql = "SELECT r.*, e.nombre as experiencia_nombre
                FROM reservas r
                LEFT JOIN experiencias e ON r.experiencia_id = e.id
                WHERE r.usuario_id = :id
                ORDER BY r.fecha_creacion DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        $reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require_once RUTA_VISTAS . 'admin/plantillas/encabezado.php';
        require_once RUTA_VISTAS . 'admin/plantillas/sidebar.php';
        require_once RUTA_VISTAS . 'admin/usuarios/historial.php';
        require_once RUTA_VISTAS . 'admin/plantillas/pie.php';
    }
}
?>