<?php
class Experiencia
{
    private $db;

    public function __construct()
    {
        $this->db = BaseDatos::conectar();
    }

    public function obtenerTodas()
    {
        try {
            $sql = "SELECT * FROM experiencias WHERE disponible = 1 ORDER BY id";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener experiencias: " . $e->getMessage());
            return [];
        }
    }

    public function obtenerPorId($id)
    {
        try {
            $sql = "SELECT * FROM experiencias WHERE id = :id AND disponible = 1";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener experiencia: " . $e->getMessage());
            return null;
        }
    }

    public function obtenerPorRegion($region)
    {
        try {
            $sql = "SELECT * FROM experiencias WHERE region = :region AND disponible = 1";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':region', $region);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener experiencias por región: " . $e->getMessage());
            return [];
        }
    }
}
?>