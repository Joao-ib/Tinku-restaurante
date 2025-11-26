<?php
class AdminControlador
{
    private $db;

    public function __construct()
    {
        $this->db = BaseDatos::conectar();
    }

    public function dashboard()
    {
        $titulo = "Dashboard - Panel de Administración";

        // Obtener métricas
        $metricas = $this->obtenerMetricas();
        $reservasRecientes = $this->obtenerReservasRecientes();
        $experienciasPopulares = $this->obtenerExperienciasPopulares();

        require_once RUTA_VISTAS . 'admin/plantillas/encabezado.php';
        require_once RUTA_VISTAS . 'admin/plantillas/sidebar.php';
        require_once RUTA_VISTAS . 'admin/dashboard.php';
        require_once RUTA_VISTAS . 'admin/plantillas/pie.php';
    }

    private function obtenerMetricas()
    {
        $metricas = [];

        // Total de reservas
        $sql = "SELECT COUNT(*) as total FROM reservas";
        $stmt = $this->db->query($sql);
        $metricas['total_reservas'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

        // Reservas de hoy
        $sql = "SELECT COUNT(*) as total FROM reservas WHERE DATE(fecha_creacion) = CURDATE()";
        $stmt = $this->db->query($sql);
        $metricas['reservas_hoy'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

        // Reservas de esta semana
        $sql = "SELECT COUNT(*) as total FROM reservas WHERE YEARWEEK(fecha_creacion) = YEARWEEK(NOW())";
        $stmt = $this->db->query($sql);
        $metricas['reservas_semana'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

        // Reservas de este mes
        $sql = "SELECT COUNT(*) as total FROM reservas WHERE MONTH(fecha_creacion) = MONTH(NOW()) AND YEAR(fecha_creacion) = YEAR(NOW())";
        $stmt = $this->db->query($sql);
        $metricas['reservas_mes'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

        // Ingresos totales
        $sql = "SELECT COALESCE(SUM(monto_total), 0) as total FROM reservas WHERE estado_pago = 'confirmado'";
        $stmt = $this->db->query($sql);
        $metricas['ingresos_totales'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

        // Ingresos de este mes
        $sql = "SELECT COALESCE(SUM(monto_total), 0) as total FROM reservas 
                WHERE estado_pago = 'confirmado' 
                AND MONTH(fecha_creacion) = MONTH(NOW()) 
                AND YEAR(fecha_creacion) = YEAR(NOW())";
        $stmt = $this->db->query($sql);
        $metricas['ingresos_mes'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

        // Total de experiencias
        $sql = "SELECT COUNT(*) as total FROM experiencias";
        $stmt = $this->db->query($sql);
        $metricas['total_experiencias'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

        // Experiencias activas
        $sql = "SELECT COUNT(*) as total FROM experiencias WHERE disponible = 1";
        $stmt = $this->db->query($sql);
        $metricas['experiencias_activas'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

        // Total de usuarios
        $sql = "SELECT COUNT(*) as total FROM usuarios";
        $stmt = $this->db->query($sql);
        $metricas['total_usuarios'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

        // Usuarios registrados este mes
        $sql = "SELECT COUNT(*) as total FROM usuarios 
                WHERE MONTH(fecha_registro) = MONTH(NOW()) 
                AND YEAR(fecha_registro) = YEAR(NOW())";
        $stmt = $this->db->query($sql);
        $metricas['usuarios_mes'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

        return $metricas;
    }

    private function obtenerReservasRecientes()
    {
        $sql = "SELECT r.*, e.nombre as experiencia_nombre, u.usuario as usuario_nombre
                FROM reservas r
                LEFT JOIN experiencias e ON r.experiencia_id = e.id
                LEFT JOIN usuarios u ON r.usuario_id = u.id
                ORDER BY r.fecha_creacion DESC
                LIMIT 10";

        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function obtenerExperienciasPopulares()
    {
        $sql = "SELECT e.nombre, e.region, COUNT(r.id) as total_reservas, SUM(r.monto_total) as ingresos
                FROM experiencias e
                LEFT JOIN reservas r ON e.id = r.experiencia_id
                GROUP BY e.id
                ORDER BY total_reservas DESC
                LIMIT 5";

        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>