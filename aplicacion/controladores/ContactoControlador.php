<?php
class ContactoControlador
{

    public function index()
    {
        $titulo = "Tinku - Contacto";
        $pagina = "contacto";
        $mensaje = '';
        $tipo_mensaje = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once RUTA_MODELOS . 'Contacto.php';
            $contactoModelo = new Contacto();

            $datos = [
                'nombre' => $_POST['nombre'] ?? '',
                'email' => $_POST['email'] ?? '',
                'asunto' => $_POST['asunto'] ?? '',
                'mensaje' => $_POST['mensaje'] ?? ''
            ];

            if ($contactoModelo->crear($datos)) {
                $mensaje = '¡Mensaje enviado con éxito! Te responderemos pronto.';
                $tipo_mensaje = 'exito';
            } else {
                $mensaje = 'Error al enviar el mensaje. Por favor, inténtalo de nuevo.';
                $tipo_mensaje = 'error';
            }
        }

        require_once RUTA_VISTAS . 'contacto/index.php';
    }
}
?>