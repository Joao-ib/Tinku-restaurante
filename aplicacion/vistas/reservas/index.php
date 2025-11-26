<?php include RUTA_VISTAS . 'plantillas/encabezado.php'; ?>
<?php include RUTA_VISTAS . 'plantillas/navegacion.php'; ?>

<main>
    <section class="seccion-reservas">
        <div class="reservas-container">
            <div class="reservas-header">
                <h1>Reserva tu Mesa</h1>
                <p>Vive una experiencia gastronómica única en Tinku</p>
            </div>

            <?php if (!empty($mensaje)): ?>
                <div class="mensaje <?php echo $tipo_mensaje; ?>">
                    <?php echo htmlspecialchars($mensaje); ?>
                </div>
            <?php endif; ?>

            <form class="formulario-reserva" method="POST" action="">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="nombre">Nombre Completo *</label>
                        <input type="text" id="nombre" name="nombre" required placeholder="Tu nombre completo">
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electrónico *</label>
                        <input type="email" id="email" name="email" required placeholder="tu@email.com">
                    </div>

                    <div class="form-group">
                        <label for="telefono">Teléfono *</label>
                        <input type="tel" id="telefono" name="telefono" required placeholder="+51 999 999 999">
                    </div>

                    <div class="form-group">
                        <label for="num_personas">Número de Personas *</label>
                        <select id="num_personas" name="num_personas" required>
                            <option value="">Selecciona...</option>
                            <option value="1">1 persona</option>
                            <option value="2">2 personas</option>
                            <option value="3">3 personas</option>
                            <option value="4">4 personas</option>
                            <option value="5">5 personas</option>
                            <option value="6">6 personas</option>
                            <option value="7">7 personas</option>
                            <option value="8">8 personas</option>
                            <option value="9">Más de 8 personas</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="fecha_reserva">Fecha *</label>
                        <input type="date" id="fecha_reserva" name="fecha_reserva" required
                            min="<?php echo date('Y-m-d'); ?>">
                    </div>

                    <div class="form-group">
                        <label for="hora_reserva">Hora *</label>
                        <input type="time" id="hora_reserva" name="hora_reserva" required min="12:00" max="22:00">
                    </div>
                </div>

                <div class="form-group full-width">
                    <label for="mensaje">Mensaje Adicional (Opcional)</label>
                    <textarea id="mensaje" name="mensaje" rows="4"
                        placeholder="Alergias, preferencias especiales, ocasión especial..."></textarea>
                </div>

                <button type="submit" class="btn-reservar">
                    Confirmar Reserva
                </button>
            </form>

            <div class="info-reservas">
                <div class="info-item">
                    <h3>📍 Ubicación</h3>
                    <p>Av. Principal 123, Miraflores, Lima</p>
                </div>
                <div class="info-item">
                    <h3>🕐 Horario</h3>
                    <p>Lunes a Domingo: 12:00 PM - 10:00 PM</p>
                </div>
                <div class="info-item">
                    <h3>📞 Teléfono</h3>
                    <p>+51 999 999 999</p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include RUTA_VISTAS . 'plantillas/pie.php'; ?>