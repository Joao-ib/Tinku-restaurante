<?php
session_start();

require_once 'configuracion/config.php';
require_once 'configuracion/basedatos.php';

require_once RUTA_CONTROLADORES . 'InicioControlador.php';

$controlador = new InicioControlador();
$controlador->index();
?>