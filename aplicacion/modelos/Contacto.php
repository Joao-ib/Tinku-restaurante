<?php
class Contacto
{
    private $db;

    public function __construct()
    {
        $this->db = BaseDatos::conectar();
    }

    public function crear($datos)
    {
        try {
            $sql = "INSERT INTO contactos (nombre, email, asunto, mensaje) 
                    VALUES (:nombre, :email, :asunto, :mensaje)";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(':nombre', $datos['nombre']);
            $stmt->bindParam(':email', $datos['email']);
            $stmt->bindParam(':asunto', $datos['asunto']);
            $stmt->bindParam(':mensaje', $datos['mensaje']);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al crear contacto: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerTodos()
    {
        try {
            $sql = "SELECT * FROM contactos ORDER BY fecha_envio DESC";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener contactos: " . $e->getMessage());
            return [];
        }
    }

    public function obtenerPorId($id)
    {
        try {
            $sql = "SELECT * FROM contactos WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener contacto: " . $e->getMessage());
            return null;
        }
    }
}
?>