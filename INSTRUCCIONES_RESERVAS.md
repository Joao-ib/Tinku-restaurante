# 🎉 Sistema de Reservas Premium - Tinku Restaurante

## ✅ Implementación Completada

Se ha implementado un sistema completo de reservas premium inspirado en Central y Maido con las siguientes características:

### 📋 Funcionalidades Implementadas

#### 1. **Catálogo de Experiencias Gastronómicas**
- 3 experiencias regionales: Costa, Sierra y Selva
- Diseño premium con tarjetas animadas
- Precios y descripciones detalladas

#### 2. **Flujo de Reserva Completo**
1. Selección de experiencia
2. Elección de fecha, hora y número de personas
3. Login/Registro de usuario
4. Confirmación de datos
5. Pago con tarjeta (validación frontend)
6. Confirmación con código único

#### 3. **Sistema de Autenticación**
- Registro de nuevos usuarios
- Login con email y contraseña
- Sesiones persistentes
- Logout

#### 4. **Pago Simulado**
- Formulario de tarjeta con validación:
  - Número de tarjeta (13-19 dígitos)
  - Fecha de expiración (formato MM/AA, no vencida)
  - CVV (3-4 dígitos)
  - Nombre del titular
- **NOTA**: El pago es simulado, no se procesa realmente

## 🚀 Instrucciones de Instalación

### 1. Actualizar la Base de Datos

Ejecuta el siguiente script SQL en phpMyAdmin:

```sql
-- Abre phpMyAdmin: http://localhost/phpmyadmin
-- Selecciona la base de datos: tinku_bd
-- Ejecuta el archivo: configuracion/schema_updates.sql
```

O copia y pega manualmente:

```sql
-- Crear tabla de experiencias
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
ADD COLUMN codigo_confirmacion VARCHAR(20);

-- Actualizar tabla de usuarios
ALTER TABLE usuarios
ADD COLUMN telefono VARCHAR(20) AFTER email;

-- Insertar las 3 experiencias
INSERT INTO experiencias (nombre, region, descripcion_corta, descripcion_larga, precio, duracion, imagen) VALUES
('Sabores de la Costa', 'Costa', 'Un viaje culinario por el Pacífico peruano', 'Explora los sabores del mar peruano en una experiencia de 8 tiempos que celebra la riqueza del océano Pacífico.', 450.00, '3 horas', 'publico/imagenes/experiencias/costa.jpg'),
('Alturas Andinas', 'Sierra', 'Degustación de productos de altura', 'Un recorrido gastronómico por los Andes peruanos, desde los 2,000 hasta los 4,500 metros de altura.', 480.00, '3.5 horas', 'publico/imagenes/experiencias/sierra.jpg'),
('Amazonía Viva', 'Selva', 'Ingredientes exóticos de la selva amazónica', 'Sumérgete en la biodiversidad de la Amazonía peruana con ingredientes silvestres y frutas exóticas.', 520.00, '4 horas', 'publico/imagenes/experiencias/selva.jpg');
```

### 2. Verificar Archivos

Asegúrate de que existan las siguientes carpetas e imágenes:
- `publico/imagenes/experiencias/` (carpeta creada)
- `publico/imagenes/experiencias/costa.jpg` ✅
- `publico/imagenes/experiencias/sierra.jpg` ✅
- `publico/imagenes/experiencias/selva.jpg` ✅

### 3. Probar el Sistema

1. **Inicia XAMPP** (Apache y MySQL)

2. **Accede a la aplicación**:
   ```
   http://localhost/tinku-restaurante/
   ```

3. **Flujo de prueba completo**:
   - Ve a "Reservas"
   - Selecciona una experiencia (ej: "Sabores de la Costa")
   - Elige fecha, hora y número de personas
   - Si no estás logueado, te pedirá crear cuenta o iniciar sesión
   - Crea una cuenta nueva con tus datos
   - Confirma los detalles de la reserva
   - Procede al pago
   - Ingresa datos de tarjeta de prueba:
     - **Número**: 4532 1234 5678 9010 (16 dígitos)
     - **Fecha**: 12/25 (cualquier fecha futura)
     - **CVV**: 123
     - **Titular**: TU NOMBRE
   - ¡Verás la confirmación con tu código de reserva!

## 📁 Archivos Nuevos Creados

### Backend
- `aplicacion/modelos/Experiencia.php`
- `aplicacion/modelos/Usuario.php`
- `aplicacion/controladores/AutenticacionControlador.php`
- `aplicacion/controladores/ReservasControlador.php` (actualizado)

### Vistas
- `aplicacion/vistas/reservas/experiencias.php`
- `aplicacion/vistas/reservas/seleccionar.php`
- `aplicacion/vistas/reservas/confirmar.php`
- `aplicacion/vistas/reservas/pago.php`
- `aplicacion/vistas/reservas/confirmacion.php`
- `aplicacion/vistas/autenticacion/login.php`
- `aplicacion/vistas/autenticacion/registro.php`

### Estilos
- `publico/estilos/experiencias.css`
- `publico/estilos/pagos.css`

### Puntos de Entrada
- `login.php`
- `registro.php`
- `logout.php`
- `reservas.php` (actualizado)

### Base de Datos
- `configuracion/schema_updates.sql`

## 🎨 Características del Diseño

- **Inspirado en Central y Maido**: Diseño premium y elegante
- **Gradientes oscuros**: Fondo sofisticado
- **Glassmorphism**: Efectos de vidrio esmerilado
- **Animaciones suaves**: Transiciones y hover effects
- **100% Responsive**: Funciona en móviles y tablets
- **Validación frontend**: Formularios con validación en tiempo real

## 🔒 Seguridad

- Contraseñas hasheadas con `password_hash()`
- Sesiones PHP para autenticación
- Validación de datos en frontend y backend
- Protección contra SQL injection con PDO prepared statements

## 📝 Notas Importantes

1. **El pago es simulado**: No se procesa ningún pago real. Solo valida el formato de la tarjeta.

2. **Imágenes generadas**: Las imágenes de las experiencias fueron generadas con IA. Puedes reemplazarlas con fotos reales.

3. **Códigos de confirmación**: Se generan automáticamente con formato `TK-XXXXXXXX`.

4. **Estados de pago**: Todas las reservas se marcan como "confirmado" automáticamente.

## 🐛 Solución de Problemas

### Error: "Table 'experiencias' doesn't exist"
- Ejecuta el script SQL en phpMyAdmin

### Error: "Column 'experiencia_id' doesn't exist"
- Ejecuta los ALTER TABLE del script SQL

### Las imágenes no se ven
- Verifica que las imágenes estén en `publico/imagenes/experiencias/`
- Revisa los permisos de la carpeta

### No puedo hacer login
- Verifica que la tabla `usuarios` tenga la columna `telefono`
- Asegúrate de haber creado una cuenta primero

## 🎯 Próximas Mejoras Sugeridas

- [ ] Integración con pasarela de pagos real (Culqi, Niubiz)
- [ ] Envío de emails de confirmación
- [ ] Panel de administración para gestionar reservas
- [ ] Calendario de disponibilidad en tiempo real
- [ ] Sistema de cancelaciones
- [ ] Recordatorios automáticos por email/SMS
- [ ] Historial de reservas del usuario
- [ ] Reseñas y calificaciones

## 📞 Soporte

Si encuentras algún problema, revisa:
1. Que XAMPP esté corriendo
2. Que la base de datos esté actualizada
3. Que todos los archivos estén en su lugar
4. Los logs de error de PHP en XAMPP

---

**¡Disfruta tu sistema de reservas premium!** 🍽️✨
