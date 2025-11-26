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
                <a href="#"><?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?></a>
                <a href="logout.php">Cerrar Sesión</a>
            <?php else: ?>
                <a href="login.php">Iniciar Sesión</a>
            <?php endif; ?>
        </div>
    </nav>
</header>