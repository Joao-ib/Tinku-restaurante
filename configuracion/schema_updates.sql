-- Tabla de experiencias gastronómicas
CREATE TABLE IF NOT EXISTS experiencias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(200) NOT NULL,
    region VARCHAR(50) NOT NULL,
    descripcion_corta TEXT NOT NULL,
    descripcion_larga TEXT NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    duracion VARCHAR(50) NOT NULL,
    imagen VARCHAR(255) NOT NULL,
    disponible TINYINT(1) DEFAULT 1,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Actualizar tabla de reservas
ALTER TABLE reservas 
ADD COLUMN experiencia_id INT AFTER id,
ADD COLUMN usuario_id INT AFTER experiencia_id,
ADD COLUMN estado_pago VARCHAR(50) DEFAULT 'pendiente',
ADD COLUMN metodo_pago VARCHAR(50),
ADD COLUMN monto_total DECIMAL(10,2),
ADD COLUMN codigo_confirmacion VARCHAR(20),
ADD FOREIGN KEY (experiencia_id) REFERENCES experiencias(id),
ADD FOREIGN KEY (usuario_id) REFERENCES usuarios(id);

-- Actualizar tabla de usuarios
ALTER TABLE usuarios
ADD COLUMN telefono VARCHAR(20) AFTER email,
ADD COLUMN direccion TEXT AFTER telefono;

-- Insertar las 3 experiencias (Costa, Sierra, Selva)
INSERT INTO experiencias (nombre, region, descripcion_corta, descripcion_larga, precio, duracion, imagen) VALUES
(
    'Sabores de la Costa',
    'Costa',
    'Un viaje culinario por el Pacífico peruano',
    'Explora los sabores del mar peruano en una experiencia de 8 tiempos que celebra la riqueza del océano Pacífico. Desde ceviches ancestrales hasta pescados de roca, cada plato cuenta la historia de nuestras costas.',
    450.00,
    '3 horas',
    'publico/imagenes/experiencias/costa.jpg'
),
(
    'Alturas Andinas',
    'Sierra',
    'Degustación de productos de altura',
    'Un recorrido gastronómico por los Andes peruanos, desde los 2,000 hasta los 4,500 metros de altura. Descubre tubérculos ancestrales, granos milenarios y técnicas de cocción que han perdurado por siglos.',
    480.00,
    '3.5 horas',
    'publico/imagenes/experiencias/sierra.jpg'
),
(
    'Amazonía Viva',
    'Selva',
    'Ingredientes exóticos de la selva amazónica',
    'Sumérgete en la biodiversidad de la Amazonía peruana. Una experiencia única con ingredientes silvestres, frutas exóticas y técnicas ancestrales de las comunidades nativas que habitan la selva.',
    520.00,
    '4 horas',
    'publico/imagenes/experiencias/selva.jpg'
);
