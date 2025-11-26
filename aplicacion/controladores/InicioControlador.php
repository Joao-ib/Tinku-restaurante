<?php
class InicioControlador {
    
    public function index() {
        $titulo = "Tinku - Inicio";
        $pagina = "inicio";
        
        require_once RUTA_VISTAS . 'inicio/index.php';
    }
}
?>