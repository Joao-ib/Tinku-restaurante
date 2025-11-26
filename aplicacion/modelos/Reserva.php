<?php
class Reserva
{
    private $db;

    public function __construct()
    {
        $this->db = BaseDatos::conectar();
    }

    public function crear($datos)
    {
        try {
            $sql = "INSERT INTO reservas (experiencia_id, usuario_id, nombre, email, telefono, fecha_reserva, hora_reserva, num_personas, mensaje, monto_total, metodo_pago, codigo_confirmacion, estado_pago) 
                    VALUES (:experiencia_id, :usuario_id, :nombre, :email, :telefono, :fecha_reserva, :hora_reserva, :num_personas, :mensaje, :monto_total, :metodo_pago, :codigo_confirmacion, :estado_pago)";

            $stmt = $this->db->prepare($sql);

            $codigoConfirmacion = $this->generarCodigoConfirmacion();

            $stmt->bindParam(':experiencia_id', $datos['experiencia_id']);
            $stmt->bindParam(':usuario_id', $datos['usuario_id']);
            $stmt->bindParam(':nombre', $datos['nombre']);
            $stmt->bindParam(':email', $datos['email']);
            $stmt->bindParam(':telefono', $datos['telefono']);
            $stmt->bindParam(':fecha_reserva', $datos['fecha_reserva']);
            $stmt->bindParam(':hora_reserva', $datos['hora_reserva']);
            $stmt->bindParam(':num_personas', $datos['num_personas']);
            $stmt->bindParam(':mensaje', $datos['mensaje']);
            $stmt->bindParam(':monto_total', $datos['monto_total']);
            $stmt->bindParam(':metodo_pago', $datos['metodo_pago']);
            $stmt->bindParam(':codigo_confirmacion', $codigoConfirmacion);
            $stmt->bindParam(':estado_pago', $datos['estado_pago']);

            if ($stmt->execute()) {
                return [
                    'success' => true,
                    'reserva_id' => $this->db->lastInsertId(),
                    'codigo_confirmacion' => $codigoConfirmacion
                ];
            }
            return ['success' => false];
        } catch (PDOException $e) {
            error_log("Error al crear reserva: " . $e->getMessage());
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function obtenerPorCodigo($codigo)
    {
        try {
            $sql = "SELECT r.*, e.nombre as experiencia_nombre, e.precio, e.region 
                    FROM reservas r 
                    LEFT JOIN experiencias e ON r.experiencia_id = e.id 
                    WHERE r.codigo_confirmacion = :codigo";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':codigo', $codigo);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener reserva: " . $e->getMessage());
            return null;
        }
    }

    public function obtenerPorUsuario($usuario_id)
    {
        try {
            $sql = "SELECT r.*, e.nombre as experiencia_nombre, e.precio, e.region 
                    FROM reservas r 
                    LEFT JOIN experiencias e ON r.experiencia_id = e.id 
                    WHERE r.usuario_id = :usuario_id 
                    ORDER BY r.fecha_reserva DESC, r.hora_reserva DESC";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':usuario_id', $usuario_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener reservas: " . $e->getMessage());
            return [];
        }
    }

    private function generarCodigoConfirmacion()
    {
        return 'TK-' . strtoupper(substr(md5(uniqid(rand(), true)), 0, 8));
    }

    public function confirmarPago($reserva_id)
    {
        try {
            $sql = "UPDATE reservas SET estado_pago = 'confirmado' WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $reserva_id);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al confirmar pago: " . $e->getMessage());
            return false;
        }
    }
}
?>