<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'tinku_bd');
define('DB_USER', 'root');
define('DB_PASS', '');

class BaseDatos {
    private static $conexion = null;
    
    public static function conectar() {
        if (self::$conexion == null) {
            try {
                self::$conexion = new PDO(
                    "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
                    DB_USER,
                    DB_PASS
                );
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conexion->exec("SET NAMES utf8");
            } catch(PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }
        return self::$conexion;
    }
}
?>