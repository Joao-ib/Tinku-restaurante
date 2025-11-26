<header>
    <nav class="BarraNavegacion">
        <div class="logo">
            <img src="publico/imagenes/logo/logo.png" alt="Tinku">
        </div>
        <div class="menu-toggle" onclick="toggleMenu()">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div id="Enlaces" class="EnlacesHeader">
            <a href="index.php">Inicio</a>
            <a href="reservas.php">Reservas</a>
            <a href="contacto.php">Contacto</a>
            <?php if (isset($_SESSION['usuario_id'])): ?>
                <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
                    <a href="admin.php" style="font-weight: 600;">
                        <?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?> 🛡️
                    </a>
                <?php else: ?>
                    <a href="#"><?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?></a>
                <?php endif; ?>
                <a href="logout.php">Cerrar Sesión</a>
            <?php else: ?>
                <a href="login.php">Iniciar Sesión</a>
            <?php endif; ?>
        </div>
    </nav>
</header>