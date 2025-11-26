<?php
class AutenticacionControlador
{

    public function login()
    {
        $titulo = "Tinku - Iniciar Sesión";
        $pagina = "login";
        $mensaje = '';
        $tipo_mensaje = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once RUTA_MODELOS . 'Usuario.php';
            $usuarioModelo = new Usuario();

            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $usuario = $usuarioModelo->login($email, $password);

            if ($usuario) {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nombre'] = $usuario['usuario'];
                $_SESSION['usuario_email'] = $usuario['email'];

                // Redirigir a donde estaba antes o a reservas
                $redirect = $_SESSION['redirect_after_login'] ?? 'reservas.php';
                unset($_SESSION['redirect_after_login']);
                header('Location: ' . $redirect);
                exit;
            } else {
                $mensaje = 'Email o contraseña incorrectos';
                $tipo_mensaje = 'error';
            }
        }

        require_once RUTA_VISTAS . 'autenticacion/login.php';
    }

    public function registro()
    {
        $titulo = "Tinku - Crear Cuenta";
        $pagina = "registro";
        $mensaje = '';
        $tipo_mensaje = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once RUTA_MODELOS . 'Usuario.php';
            $usuarioModelo = new Usuario();

            $datos = [
                'usuario' => $_POST['nombre'] ?? '',
                'email' => $_POST['email'] ?? '',
                'telefono' => $_POST['telefono'] ?? '',
                'password' => $_POST['password'] ?? ''
            ];

            // Validar que el email no exista
            if ($usuarioModelo->emailExiste($datos['email'])) {
                $mensaje = 'Este email ya está registrado';
                $tipo_mensaje = 'error';
            } else {
                $usuario_id = $usuarioModelo->registrar($datos);

                if ($usuario_id) {
                    // Auto-login después del registro
                    $_SESSION['usuario_id'] = $usuario_id;
                    $_SESSION['usuario_nombre'] = $datos['usuario'];
                    $_SESSION['usuario_email'] = $datos['email'];

                    // Redirigir a donde estaba antes o a reservas
                    $redirect = $_SESSION['redirect_after_login'] ?? 'reservas.php';
                    unset($_SESSION['redirect_after_login']);
                    header('Location: ' . $redirect);
                    exit;
                } else {
                    $mensaje = 'Error al crear la cuenta. Inténtalo de nuevo.';
                    $tipo_mensaje = 'error';
                }
            }
        }

        require_once RUTA_VISTAS . 'autenticacion/registro.php';
    }

    public function logout()
    {
        session_destroy();
        header('Location: index.php');
        exit;
    }
}
?>