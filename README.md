# 🍽️ Tinku - Cocina de Encuentros

Sistema web integral para restaurante peruano que incluye gestión de reservas, autenticación de usuarios y un panel de administración completo.

## 📋 Descripción

Tinku es una aplicación web desarrollada en PHP con arquitectura MVC. No solo permite a los clientes reservar y contactar, sino que incluye un **sistema de gestión interno** donde los administradores pueden controlar las reservas y mensajes recibidos.

### 🚀 Funcionalidades Implementadas

**Para el Cliente:**
* **Reservas en línea:** Formulario validado para agendar mesas.
* **Registro y Login:** Los usuarios pueden crear cuentas personales.
* **Contacto:** Envío directo de mensajes a la administración.
* **Diseño Responsive:** Adaptable a móviles y escritorio.

**Para el Administrador:**
* **Panel de Control (Dashboard):** Vista protegida (`admin.php`).
* **Gestión de Reservas:** Visualización de todas las reservas activas.
* **Buzón de Mensajes:** Lectura de consultas enviadas desde el contacto.
* **Seguridad:** Sistema de login y logout con sesiones seguras.

## 🛠️ Tecnologías

* **Backend:** PHP 7.4+
* **Base de Datos:** MySQL
* **Frontend:** HTML5, CSS3, JavaScript (Glassmorphism UI)
* **Servidor:** XAMPP (Apache)

## 📁 Estructura del Proyecto

```text
Tinku-restaurante/
├── aplicacion/          # Lógica MVC
├── configuracion/       # Conexión a BD
├── publico/             # CSS, JS e Imágenes
├── index.php            # Página de inicio
├── login.php            # Ingreso de usuarios/admin
├── registro.php         # Creación de nuevas cuentas
├── admin.php            # Panel de control (Protegido)
├── crear_admin.php      # Script de configuración inicial
├── reservas.php         # Módulo de reservas
└── contacto.php         # Módulo de contacto
```

⚙️ Instalación y Despliegue
Clonar repositorio en htdocs:

Bash
git clone [https://github.com/Joao-ib/Tinku-restaurante.git](https://github.com/Joao-ib/Tinku-restaurante.git)

Base de Datos:

Crea una BD llamada tinku_bd en phpMyAdmin.

Importa el archivo configuracion/tinku_bd.sql.

Configuración Inicial:

Revisa configuracion/config.php y basedatos.php para asegurar que las credenciales (root/vacío) coincidan con tu XAMPP.

Crear el Primer Administrador:

Para entrar al panel, necesitas un usuario con rol de admin.

Ve al navegador: http://localhost/tinku-restaurante/crear_admin.php

Crea tus credenciales y luego inicia sesión en /login.php.


📄 Licencia
Este proyecto es de código abierto y está disponible bajo la licencia MIT.

👥 Autor
Desarrollado por Joao-ib
