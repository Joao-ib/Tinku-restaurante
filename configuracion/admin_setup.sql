-- Actualizar tabla usuarios para soportar rol admin
ALTER TABLE usuarios 
MODIFY COLUMN rol ENUM('usuario', 'admin') DEFAULT 'usuario';

-- Crear un usuario admin de prueba
-- Contraseña: admin123 (hasheada)
INSERT INTO usuarios (usuario, email, telefono, password, rol) 
VALUES ('Administrador', 'admin@tinku.pe', '+51 999 999 999', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin')
ON DUPLICATE KEY UPDATE rol = 'admin';

-- Agregar índice para mejorar búsquedas por rol
ALTER TABLE usuarios ADD INDEX idx_rol (rol);

-- Agregar campo activo para usuarios
ALTER TABLE usuarios 
ADD COLUMN activo TINYINT(1) DEFAULT 1 AFTER rol;
