<?php
class Usuario
{
    private $db;

    public function __construct()
    {
        $this->db = BaseDatos::conectar();
    }

    public function registrar($datos)
    {
        try {
            $sql = "INSERT INTO usuarios (usuario, email, telefono, password, rol) 
                    VALUES (:usuario, :email, :telefono, :password, 'usuario')";

            $stmt = $this->db->prepare($sql);

            $passwordHash = password_hash($datos['password'], PASSWORD_DEFAULT);

            $stmt->bindParam(':usuario', $datos['usuario']);
            $stmt->bindParam(':email', $datos['email']);
            $stmt->bindParam(':telefono', $datos['telefono']);
            $stmt->bindParam(':password', $passwordHash);

            if ($stmt->execute()) {
                return $this->db->lastInsertId();
            }
            return false;
        } catch (PDOException $e) {
            error_log("Error al registrar usuario: " . $e->getMessage());
            return false;
        }
    }

    public function login($email, $password)
    {
        try {
            $sql = "SELECT * FROM usuarios WHERE email = :email";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario && password_verify($password, $usuario['password'])) {
                return $usuario;
            }
            return false;
        } catch (PDOException $e) {
            error_log("Error al hacer login: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerPorId($id)
    {
        try {
            $sql = "SELECT id, usuario, email, telefono, rol, fecha_registro FROM usuarios WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener usuario: " . $e->getMessage());
            return null;
        }
    }

    public function emailExiste($email)
    {
        try {
            $sql = "SELECT COUNT(*) FROM usuarios WHERE email = :email";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>