<?php
session_start();

require_once 'configuracion/config.php';
require_once 'configuracion/basedatos.php';

require_once RUTA_CONTROLADORES . 'ReservasControlador.php';

$controlador = new ReservasControlador();

// Obtener la acción desde la URL
$action = $_GET['action'] ?? 'index';

// Ejecutar la acción correspondiente
switch ($action) {
    case 'seleccionar':
        $controlador->seleccionar();
        break;
    case 'confirmar':
        $controlador->confirmar();
        break;
    case 'pagar':
        $controlador->pagar();
        break;
    case 'procesar':
        $controlador->procesar();
        break;
    case 'confirmacion':
        $controlador->confirmacion();
        break;
    default:
        $controlador->index();
        break;
}
?>