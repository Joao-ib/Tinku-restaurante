<?php include RUTA_VISTAS . 'plantillas/encabezado.php'; ?>
<?php include RUTA_VISTAS . 'plantillas/navegacion.php'; ?>

<main>
    <section class="seccion-contacto">
        <div class="contacto-container">
            <div class="contacto-header">
                <h1>Contáctanos</h1>
                <p>Estamos aquí para responder tus preguntas</p>
            </div>

            <?php if (!empty($mensaje)): ?>
                <div class="mensaje <?php echo $tipo_mensaje; ?>">
                    <?php echo htmlspecialchars($mensaje); ?>
                </div>
            <?php endif; ?>

            <div class="contacto-content">
                <form class="formulario-contacto" method="POST" action="">
                    <div class="form-group">
                        <label for="nombre">Nombre Completo *</label>
                        <input type="text" id="nombre" name="nombre" required placeholder="Tu nombre completo">
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electrónico *</label>
                        <input type="email" id="email" name="email" required placeholder="tu@email.com">
                    </div>

                    <div class="form-group">
                        <label for="asunto">Asunto *</label>
                        <input type="text" id="asunto" name="asunto" required placeholder="¿En qué podemos ayudarte?">
                    </div>

                    <div class="form-group">
                        <label for="mensaje">Mensaje *</label>
                        <textarea id="mensaje" name="mensaje" rows="6" required
                            placeholder="Escribe tu mensaje aquí..."></textarea>
                    </div>

                    <button type="submit" class="btn-enviar">
                        Enviar Mensaje
                    </button>
                </form>

                <div class="contacto-info">
                    <div class="info-card">
                        <div class="icon">📍</div>
                        <h3>Dirección</h3>
                        <p>Av. Principal 123<br>Miraflores, Lima 15074<br>Perú</p>
                    </div>

                    <div class="info-card">
                        <div class="icon">📞</div>
                        <h3>Teléfono</h3>
                        <p>+51 999 999 999<br>+51 01 234 5678</p>
                    </div>

                    <div class="info-card">
                        <div class="icon">✉️</div>
                        <h3>Email</h3>
                        <p>info@tinku.pe<br>reservas@tinku.pe</p>
                    </div>

                    <div class="info-card">
                        <div class="icon">🕐</div>
                        <h3>Horario de Atención</h3>
                        <p>Lunes a Domingo<br>12:00 PM - 10:00 PM</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include RUTA_VISTAS . 'plantillas/pie.php'; ?>