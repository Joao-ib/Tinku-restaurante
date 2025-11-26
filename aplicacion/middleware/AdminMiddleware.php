<?php
/**
 * Middleware para verificar que el usuario sea administrador
 */

function verificarAdmin()
{
    // Verificar que haya sesión activa
    if (!isset($_SESSION['usuario_id'])) {
        $_SESSION['mensaje'] = 'Debes iniciar sesión para acceder al panel de administración';
        $_SESSION['tipo_mensaje'] = 'error';
        header('Location: login.php?redirect=admin.php');
        exit;
    }

    // Verificar que el usuario sea admin
    if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
        $_SESSION['mensaje'] = 'No tienes permisos para acceder al panel de administración';
        $_SESSION['tipo_mensaje'] = 'error';
        header('Location: index.php');
        exit;
    }

    return true;
}

function verificarSesion()
{
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: login.php');
        exit;
    }
    return true;
}

function esAdmin()
{
    return isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin';
}
?>