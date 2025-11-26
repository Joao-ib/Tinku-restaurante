<?php
// Script para crear/actualizar el usuario admin con la contraseña correcta

require_once 'configuracion/config.php';
require_once 'configuracion/basedatos.php';

$db = BaseDatos::conectar();

// Generar hash correcto para la contraseña "admin123"
$password = 'admin123';
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

echo "Hash generado: " . $passwordHash . "\n\n";

// Verificar si el usuario admin existe
$sql = "SELECT * FROM usuarios WHERE email = 'admin@tinku.pe'";
$stmt = $db->query($sql);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if ($usuario) {
    // Actualizar usuario existente
    $sql = "UPDATE usuarios SET password = :password, rol = 'admin' WHERE email = 'admin@tinku.pe'";
    $stmt = $db->prepare($sql);
    $stmt->execute([':password' => $passwordHash]);
    echo "✅ Usuario admin actualizado correctamente\n";
} else {
    // Crear nuevo usuario admin
    $sql = "INSERT INTO usuarios (usuario, email, telefono, password, rol) 
            VALUES ('Administrador', 'admin@tinku.pe', '+51 999 999 999', :password, 'admin')";
    $stmt = $db->prepare($sql);
    $stmt->execute([':password' => $passwordHash]);
    echo "✅ Usuario admin creado correctamente\n";
}

// Verificar que funciona el login
$sql = "SELECT * FROM usuarios WHERE email = 'admin@tinku.pe'";
$stmt = $db->query($sql);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if ($usuario && password_verify('admin123', $usuario['password'])) {
    echo "✅ Login verificado correctamente\n";
    echo "\nDatos del usuario admin:\n";
    echo "- ID: " . $usuario['id'] . "\n";
    echo "- Nombre: " . $usuario['usuario'] . "\n";
    echo "- Email: " . $usuario['email'] . "\n";
    echo "- Rol: " . $usuario['rol'] . "\n";
} else {
    echo "❌ Error: No se pudo verificar el login\n";
}

echo "\n===========================================\n";
echo "Ahora puedes iniciar sesión con:\n";
echo "Email: admin@tinku.pe\n";
echo "Contraseña: admin123\n";
echo "===========================================\n";
?>