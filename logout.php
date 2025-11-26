<?php
session_start();

require_once 'configuracion/config.php';
require_once 'configuracion/basedatos.php';

require_once RUTA_CONTROLADORES . 'AutenticacionControlador.php';

$controlador = new AutenticacionControlador();
$controlador->logout();
?>