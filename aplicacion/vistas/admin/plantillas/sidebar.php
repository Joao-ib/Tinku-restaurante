<div class="admin-sidebar">
    <div class="sidebar-header">
        <img src="publico/imagenes/logo/logo.png" alt="Tinku" class="sidebar-logo">
        <h2>Panel Admin</h2>
    </div>

    <nav class="sidebar-nav">
        <a href="admin.php" class="nav-item <?php echo (!isset($_GET['module']) ? 'active' : ''); ?>">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
        </a>

        <div class="nav-section">
            <div class="nav-section-title">Gestión</div>

            <a href="admin.php?module=experiencias"
                class="nav-item <?php echo (isset($_GET['module']) && $_GET['module'] == 'experiencias' ? 'active' : ''); ?>">
                <i class="fas fa-utensils"></i>
                <span>Experiencias</span>
            </a>

            <a href="admin.php?module=reservas"
                class="nav-item <?php echo (isset($_GET['module']) && $_GET['module'] == 'reservas' ? 'active' : ''); ?>">
                <i class="fas fa-calendar-check"></i>
                <span>Reservas</span>
            </a>

            <a href="admin.php?module=usuarios"
                class="nav-item <?php echo (isset($_GET['module']) && $_GET['module'] == 'usuarios' ? 'active' : ''); ?>">
                <i class="fas fa-users"></i>
                <span>Usuarios</span>
            </a>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Sistema</div>

            <a href="index.php" class="nav-item" target="_blank">
                <i class="fas fa-external-link-alt"></i>
                <span>Ver Sitio</span>
            </a>

            <a href="logout.php" class="nav-item">
                <i class="fas fa-sign-out-alt"></i>
                <span>Cerrar Sesión</span>
            </a>
        </div>
    </nav>
</div>

<div class="admin-main">
    <header class="admin-header">
        <div class="header-left">
            <button class="menu-toggle" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <h1><?php echo $titulo ?? 'Dashboard'; ?></h1>
        </div>
        <div class="header-right">
            <div class="admin-user">
                <i class="fas fa-user-circle"></i>
                <span><?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?></span>
                <span class="badge-admin">Admin</span>
            </div>
        </div>
    </header>

    <main class="admin-content">
        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="alert alert-<?php echo $_SESSION['tipo_mensaje'] ?? 'info'; ?>">
                <?php
                echo htmlspecialchars($_SESSION['mensaje']);
                unset($_SESSION['mensaje']);
                unset($_SESSION['tipo_mensaje']);
                ?>
            </div>
        <?php endif; ?>