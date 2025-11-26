# 🍽️ Tinku - Cocina de Encuentros

Sistema web para restaurante peruano con gestión de reservas y contacto.

## 📋 Descripción

Tinku es una aplicación web desarrollada en PHP con arquitectura MVC que permite a los usuarios:
- Ver información del restaurante
- Realizar reservas en línea
- Enviar mensajes de contacto
- Experiencia responsive para móviles y tablets

## 🛠️ Tecnologías Utilizadas

- **Backend**: PHP 7.4+
- **Base de Datos**: MySQL
- **Frontend**: HTML5, CSS3, JavaScript
- **Servidor**: XAMPP (Apache + MySQL)
- **Arquitectura**: MVC (Modelo-Vista-Controlador)

## 📁 Estructura del Proyecto

```
Tinku-restaurante/
├── aplicacion/
│   ├── controladores/
│   │   ├── InicioControlador.php
│   │   ├── ReservasControlador.php
│   │   └── ContactoControlador.php
│   ├── modelos/
│   │   ├── Reserva.php
│   │   └── Contacto.php
│   └── vistas/
│       ├── inicio/
│       ├── reservas/
│       ├── contacto/
│       └── plantillas/
├── configuracion/
│   ├── config.php
│   ├── basedatos.php
│   └── tinku_bd.sql
├── publico/
│   ├── estilos/
│   │   ├── principal.css
│   │   ├── componentes.css
│   │   └── responsivo.css
│   ├── scripts/
│   │   ├── menu.js
│   │   └── carrusel.js
│   └── imagenes/
├── index.php
├── reservas.php
└── contacto.php
```

## 🚀 Instalación

### 1. Requisitos Previos
- XAMPP instalado
- PHP 7.4 o superior
- MySQL 5.7 o superior

### 2. Configuración de la Base de Datos

1. Inicia XAMPP y activa Apache y MySQL
2. Abre phpMyAdmin: `http://localhost/phpmyadmin`
3. Importa el archivo SQL:
   ```sql
   -- Ejecuta el archivo: configuracion/tinku_bd.sql
   ```

   O ejecuta manualmente:
   ```sql
   CREATE DATABASE IF NOT EXISTS tinku_bd;
   USE tinku_bd;
   
   -- Luego ejecuta las tablas del archivo tinku_bd.sql
   ```

### 3. Configuración del Proyecto

1. Clona el repositorio en `c:\xampp\htdocs\`:
   ```bash
   cd c:\xampp\htdocs
   git clone https://github.com/Joao-ib/Tinku-restaurante.git
   ```

2. Verifica la configuración en `configuracion/config.php`:
   ```php
   define('URL_BASE', 'http://localhost/tinku-restaurante/');
   ```

3. Verifica la configuración de base de datos en `configuracion/basedatos.php`:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'tinku_bd');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   ```

### 4. Acceder a la Aplicación

Abre tu navegador y visita:
```
http://localhost/tinku-restaurante/
```

## 📊 Base de Datos

### Tablas

#### `reservas`
- `id`: INT (PK, AUTO_INCREMENT)
- `nombre`: VARCHAR(100)
- `email`: VARCHAR(100)
- `telefono`: VARCHAR(20)
- `fecha_reserva`: DATE
- `hora_reserva`: TIME
- `num_personas`: INT
- `mensaje`: TEXT
- `fecha_creacion`: TIMESTAMP

#### `contactos`
- `id`: INT (PK, AUTO_INCREMENT)
- `nombre`: VARCHAR(100)
- `email`: VARCHAR(100)
- `asunto`: VARCHAR(200)
- `mensaje`: TEXT
- `fecha_envio`: TIMESTAMP

#### `usuarios`
- `id`: INT (PK, AUTO_INCREMENT)
- `usuario`: VARCHAR(50) UNIQUE
- `email`: VARCHAR(100) UNIQUE
- `password`: VARCHAR(255)
- `rol`: ENUM('admin', 'usuario')
- `fecha_registro`: TIMESTAMP

## 🎨 Características del Diseño

- **Diseño Moderno**: Gradientes oscuros con efectos glassmorphism
- **Animaciones**: Transiciones suaves y efectos hover
- **Responsive**: Adaptado para móviles, tablets y desktop
- **Carrusel**: Presentación automática de imágenes
- **Formularios Elegantes**: Con validación y mensajes de confirmación

## 📱 Páginas Disponibles

1. **Inicio** (`index.php`)
   - Carrusel de imágenes
   - Historia del restaurante
   
2. **Reservas** (`reservas.php`)
   - Formulario de reserva
   - Información de contacto
   
3. **Contacto** (`contacto.php`)
   - Formulario de contacto
   - Datos de ubicación y horarios

## 🔧 Funcionalidades

### Reservas
- Formulario con validación
- Campos: nombre, email, teléfono, fecha, hora, número de personas
- Mensaje opcional para alergias o preferencias
- Confirmación visual del envío

### Contacto
- Formulario de contacto general
- Campos: nombre, email, asunto, mensaje
- Información de ubicación y horarios
- Confirmación visual del envío

## 🎯 Próximas Mejoras

- [ ] Sistema de login para usuarios
- [ ] Panel de administración
- [ ] Gestión de menú
- [ ] Sistema de pedidos en línea
- [ ] Integración con pasarelas de pago
- [ ] Notificaciones por email
- [ ] Dashboard de estadísticas

## 👨‍💻 Desarrollo

### Agregar una Nueva Página

1. Crear el controlador en `aplicacion/controladores/`
2. Crear la vista en `aplicacion/vistas/`
3. Crear el archivo PHP de entrada en la raíz
4. Agregar el enlace en `aplicacion/vistas/plantillas/navegacion.php`

### Agregar un Nuevo Modelo

1. Crear el archivo en `aplicacion/modelos/`
2. Extender la clase con conexión a la base de datos
3. Implementar métodos CRUD necesarios

## 📄 Licencia

Este proyecto es de código abierto y está disponible bajo la licencia MIT.

## 👥 Autor

Desarrollado por Joao-ib

## 🤝 Contribuciones

Las contribuciones son bienvenidas. Por favor:
1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📞 Soporte

Para soporte, abre un issue en el repositorio de GitHub.

---

**Tinku - Donde los sabores se encuentran** 🇵🇪
