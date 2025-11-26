<?php
class ReservasControlador
{

    // Paso 1: Mostrar catálogo de experiencias
    public function index()
    {
        $titulo = "Tinku - Experiencias Gastronómicas";
        $pagina = "experiencias";

        require_once RUTA_MODELOS . 'Experiencia.php';
        $experienciaModelo = new Experiencia();
        $experiencias = $experienciaModelo->obtenerTodas();

        require_once RUTA_VISTAS . 'reservas/experiencias.php';
    }

    // Paso 2: Seleccionar fecha, hora y personas
    public function seleccionar()
    {
        $experiencia_id = $_GET['id'] ?? null;

        if (!$experiencia_id) {
            header('Location: reservas.php');
            exit;
        }

        require_once RUTA_MODELOS . 'Experiencia.php';
        $experienciaModelo = new Experiencia();
        $experiencia = $experienciaModelo->obtenerPorId($experiencia_id);

        if (!$experiencia) {
            header('Location: reservas.php');
            exit;
        }

        $titulo = "Tinku - " . $experiencia['nombre'];
        $pagina = "seleccionar";

        // Guardar en sesión para los siguientes pasos
        $_SESSION['experiencia_seleccionada'] = $experiencia;

        require_once RUTA_VISTAS . 'reservas/seleccionar.php';
    }

    // Paso 3: Verificar login y confirmar datos
    public function confirmar()
    {
        // Verificar que haya experiencia seleccionada
        if (!isset($_SESSION['experiencia_seleccionada'])) {
            header('Location: reservas.php');
            exit;
        }

        // Verificar que el usuario esté logueado
        if (!isset($_SESSION['usuario_id'])) {
            $_SESSION['redirect_after_login'] = 'reservas.php?action=confirmar';
            $_SESSION['datos_reserva'] = $_POST;
            header('Location: login.php');
            exit;
        }

        $titulo = "Tinku - Confirmar Reserva";
        $pagina = "confirmar";

        // Obtener datos del usuario
        require_once RUTA_MODELOS . 'Usuario.php';
        $usuarioModelo = new Usuario();
        $usuario = $usuarioModelo->obtenerPorId($_SESSION['usuario_id']);

        $experiencia = $_SESSION['experiencia_seleccionada'];

        // Datos de la reserva desde el formulario anterior
        $datos_reserva = $_SESSION['datos_reserva'] ?? $_POST;

        require_once RUTA_VISTAS . 'reservas/confirmar.php';
    }

    // Paso 4: Procesar pago
    public function pagar()
    {
        if (!isset($_SESSION['usuario_id']) || !isset($_SESSION['experiencia_seleccionada'])) {
            header('Location: reservas.php');
            exit;
        }

        $titulo = "Tinku - Pago";
        $pagina = "pago";

        $experiencia = $_SESSION['experiencia_seleccionada'];
        $datos_reserva = $_POST;

        // Guardar datos de reserva en sesión
        $_SESSION['datos_reserva_final'] = $datos_reserva;

        require_once RUTA_VISTAS . 'reservas/pago.php';
    }

    // Paso 5: Procesar el pago y crear la reserva
    public function procesar()
    {
        if (!isset($_SESSION['usuario_id']) || !isset($_SESSION['experiencia_seleccionada'])) {
            header('Location: reservas.php');
            exit;
        }

        require_once RUTA_MODELOS . 'Reserva.php';
        require_once RUTA_MODELOS . 'Usuario.php';

        $reservaModelo = new Reserva();
        $usuarioModelo = new Usuario();

        $usuario = $usuarioModelo->obtenerPorId($_SESSION['usuario_id']);
        $experiencia = $_SESSION['experiencia_seleccionada'];
        $datos_reserva = $_SESSION['datos_reserva_final'];

        // Calcular monto total
        $num_personas = $datos_reserva['num_personas'];
        $monto_total = $experiencia['precio'] * $num_personas;

        // Crear la reserva
        $datos = [
            'experiencia_id' => $experiencia['id'],
            'usuario_id' => $_SESSION['usuario_id'],
            'nombre' => $usuario['usuario'],
            'email' => $usuario['email'],
            'telefono' => $usuario['telefono'] ?? '',
            'fecha_reserva' => $datos_reserva['fecha_reserva'],
            'hora_reserva' => $datos_reserva['hora_reserva'],
            'num_personas' => $num_personas,
            'mensaje' => $datos_reserva['mensaje'] ?? '',
            'monto_total' => $monto_total,
            'metodo_pago' => $_POST['metodo_pago'] ?? 'tarjeta',
            'estado_pago' => 'confirmado' // Simulamos que el pago fue exitoso
        ];

        $resultado = $reservaModelo->crear($datos);

        if ($resultado['success']) {
            // Limpiar sesión
            unset($_SESSION['experiencia_seleccionada']);
            unset($_SESSION['datos_reserva']);
            unset($_SESSION['datos_reserva_final']);

            // Redirigir a confirmación
            header('Location: reservas.php?action=confirmacion&codigo=' . $resultado['codigo_confirmacion']);
            exit;
        } else {
            // Error al crear reserva
            header('Location: reservas.php');
            exit;
        }
    }

    // Paso 6: Mostrar confirmación
    public function confirmacion()
    {
        $codigo = $_GET['codigo'] ?? null;

        if (!$codigo) {
            header('Location: reservas.php');
            exit;
        }

        require_once RUTA_MODELOS . 'Reserva.php';
        $reservaModelo = new Reserva();
        $reserva = $reservaModelo->obtenerPorCodigo($codigo);

        if (!$reserva) {
            header('Location: reservas.php');
            exit;
        }

        $titulo = "Tinku - Reserva Confirmada";
        $pagina = "confirmacion";

        require_once RUTA_VISTAS . 'reservas/confirmacion.php';
    }
}
?>