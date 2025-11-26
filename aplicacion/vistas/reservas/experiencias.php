<?php include RUTA_VISTAS . 'plantillas/encabezado.php'; ?>
<?php include RUTA_VISTAS . 'plantillas/navegacion.php'; ?>

<main>
    <section class="hero-experiencias">
        <div class="hero-content">
            <h1>Experiencias Gastronómicas</h1>
            <p>Un viaje culinario por las tres regiones del Perú</p>
        </div>
    </section>

    <section class="catalogo-experiencias">
        <div class="experiencias-grid">
            <?php foreach ($experiencias as $exp): ?>
                <div class="experiencia-card" data-region="<?php echo strtolower($exp['region']); ?>">
                    <div class="experiencia-imagen">
                        <img src="<?php echo $exp['imagen']; ?>" alt="<?php echo htmlspecialchars($exp['nombre']); ?>"
                            onerror="this.src='publico/imagenes/placeholder.jpg'">
                        <div class="experiencia-overlay">
                            <span class="region-tag"><?php echo htmlspecialchars($exp['region']); ?></span>
                        </div>
                    </div>
                    <div class="experiencia-info">
                        <h2><?php echo htmlspecialchars($exp['nombre']); ?></h2>
                        <p class="descripcion"><?php echo htmlspecialchars($exp['descripcion_corta']); ?></p>
                        <div class="experiencia-detalles">
                            <div class="detalle">
                                <span class="icono">⏱️</span>
                                <span><?php echo htmlspecialchars($exp['duracion']); ?></span>
                            </div>
                            <div class="detalle precio">
                                <span class="icono">💰</span>
                                <span>S/ <?php echo number_format($exp['precio'], 2); ?></span>
                                <small>por persona</small>
                            </div>
                        </div>
                        <a href="reservas.php?action=seleccionar&id=<?php echo $exp['id']; ?>" class="btn-reservar-exp">
                            Reservar esta experiencia
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="info-adicional">
        <div class="info-container">
            <div class="info-box">
                <h3>🍽️ Menú Degustación</h3>
                <p>Cada experiencia incluye un menú de degustación de 8 a 12 tiempos</p>
            </div>
            <div class="info-box">
                <h3>🍷 Maridaje Opcional</h3>
                <p>Disponible maridaje con vinos y bebidas artesanales peruanas</p>
            </div>
            <div class="info-box">
                <h3>👨‍🍳 Chef Ejecutivo</h3>
                <p>Experiencias dirigidas por nuestro equipo de chefs especializados</p>
            </div>
        </div>
    </section>
</main>

<?php include RUTA_VISTAS . 'plantillas/pie.php'; ?>