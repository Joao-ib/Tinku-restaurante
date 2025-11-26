<?php include RUTA_VISTAS . 'plantillas/encabezado.php'; ?>
<?php include RUTA_VISTAS . 'plantillas/navegacion.php'; ?>

<main>
    <section class="seccion-seleccion">
        <div class="seleccion-container">
            <div class="experiencia-detalle">
                <div class="detalle-imagen">
                    <img src="<?php echo $experiencia['imagen']; ?>"
                        alt="<?php echo htmlspecialchars($experiencia['nombre']); ?>"
                        onerror="this.src='publico/imagenes/placeholder.jpg'">
                </div>
                <div class="detalle-texto">
                    <span class="region-badge"><?php echo htmlspecialchars($experiencia['region']); ?></span>
                    <h1><?php echo htmlspecialchars($experiencia['nombre']); ?></h1>
                    <p class="descripcion-larga"><?php echo htmlspecialchars($experiencia['descripcion_larga']); ?></p>
                    <div class="caracteristicas">
                        <div class="caracteristica">
                            <strong>Duración:</strong> <?php echo htmlspecialchars($experiencia['duracion']); ?>
                        </div>
                        <div class="caracteristica">
                            <strong>Precio:</strong> S/ <?php echo number_format($experiencia['precio'], 2); ?> por
                            persona
                        </div>
                    </div>
                </div>
            </div>

            <div class="formulario-seleccion">
                <h2>Selecciona tu reserva</h2>
                <form method="POST" action="reservas.php?action=confirmar" id="formSeleccion">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="fecha_reserva">Fecha *</label>
                            <input type="date" id="fecha_reserva" name="fecha_reserva" required
                                min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
                        </div>

                        <div class="form-group">
                            <label for="hora_reserva">Horario *</label>
                            <select id="hora_reserva" name="hora_reserva" required>
                                <option value="">Selecciona un horario</option>
                                <option value="13:00">13:00 - Almuerzo</option>
                                <option value="13:30">13:30 - Almuerzo</option>
                                <option value="19:30">19:30 - Cena</option>
                                <option value="20:00">20:00 - Cena</option>
                                <option value="20:30">20:30 - Cena</option>
                            </select>
                        </div>
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
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="mensaje">Comentarios o solicitudes especiales (Opcional)</label>
                        <textarea id="mensaje" name="mensaje" rows="3"
                            placeholder="Alergias, preferencias alimentarias, ocasión especial..."></textarea>
                    </div>

                    <div class="resumen-precio">
                        <div class="precio-base">
                            <span>Precio por persona:</span>
                            <span class="monto">S/ <?php echo number_format($experiencia['precio'], 2); ?></span>
                        </div>
                        <div class="precio-total" id="precioTotal" style="display:none;">
                            <span>Total:</span>
                            <span class="monto" id="montoTotal">S/ 0.00</span>
                        </div>
                    </div>

                    <button type="submit" class="btn-continuar">Continuar</button>
                </form>
            </div>
        </div>
    </section>
</main>

<script>
    // Calcular precio total
    document.getElementById('num_personas').addEventListener('change', function () {
        const numPersonas = parseInt(this.value);
        const precioBase = <?php echo $experiencia['precio']; ?>;

        if (numPersonas > 0) {
            const total = numPersonas * precioBase;
            document.getElementById('montoTotal').textContent = 'S/ ' + total.toFixed(2);
            document.getElementById('precioTotal').style.display = 'flex';
        } else {
            document.getElementById('precioTotal').style.display = 'none';
        }
    });
</script>

<?php include RUTA_VISTAS . 'plantillas/pie.php'; ?>