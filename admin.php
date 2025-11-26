<?php
session_start();

require_once 'configuracion/config.php';
require_once 'configuracion/basedatos.php';
require_once 'aplicacion/middleware/AdminMiddleware.php';

// Verificar que el usuario sea admin
verificarAdmin();

// Obtener módulo y acción
$module = $_GET['module'] ?? '';
$action = $_GET['action'] ?? 'index';

// Enrutar según el módulo
switch ($module) {
    case 'experiencias':
        require_once RUTA_CONTROLADORES . 'AdminExperienciasControlador.php';
        $controlador = new AdminExperienciasControlador();
        break;

    case 'reservas':
        require_once RUTA_CONTROLADORES . 'AdminReservasControlador.php';
        $controlador = new AdminReservasControlador();
        break;

    case 'usuarios':
        require_once RUTA_CONTROLADORES . 'AdminUsuariosControlador.php';
        $controlador = new AdminUsuariosControlador();
        break;

    default:
        require_once RUTA_CONTROLADORES . 'AdminControlador.php';
        $controlador = new AdminControlador();
        $action = 'dashboard';
        break;
}

// Ejecutar la acción
if (method_exists($controlador, $action)) {
    $controlador->$action();
} else {
    // Acción no encontrada, ir al dashboard
    require_once RUTA_CONTROLADORES . 'AdminControlador.php';
    $controlador = new AdminControlador();
    $controlador->dashboard();
}
?>