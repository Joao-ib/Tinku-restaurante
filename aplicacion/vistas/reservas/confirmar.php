<?php include RUTA_VISTAS . 'plantillas/encabezado.php'; ?>
<?php include RUTA_VISTAS . 'plantillas/navegacion.php'; ?>

<main>
    <section class="seccion-confirmar">
        <div class="confirmar-container">
            <h1>Confirma tu Reserva</h1>
            <p class="subtitulo">Revisa los detalles antes de proceder al pago</p>

            <div class="resumen-reserva">
                <div class="resumen-experiencia">
                    <h2>Experiencia Seleccionada</h2>
                    <div class="exp-card-small">
                        <img src="<?php echo $experiencia['imagen']; ?>"
                            alt="<?php echo htmlspecialchars($experiencia['nombre']); ?>"
                            onerror="this.src='publico/imagenes/placeholder.jpg'">
                        <div>
                            <h3><?php echo htmlspecialchars($experiencia['nombre']); ?></h3>
                            <p><?php echo htmlspecialchars($experiencia['region']); ?></p>
                        </div>
                    </div>
                </div>

                <div class="resumen-detalles">
                    <h2>Detalles de la Reserva</h2>
                    <div class="detalle-item">
                        <span class="label">Fecha:</span>
                        <span
                            class="valor"><?php echo date('d/m/Y', strtotime($datos_reserva['fecha_reserva'])); ?></span>
                    </div>
                    <div class="detalle-item">
                        <span class="label">Hora:</span>
                        <span class="valor"><?php echo $datos_reserva['hora_reserva']; ?></span>
                    </div>
                    <div class="detalle-item">
                        <span class="label">Personas:</span>
                        <span class="valor"><?php echo $datos_reserva['num_personas']; ?></span>
                    </div>
                    <?php if (!empty($datos_reserva['mensaje'])): ?>
                        <div class="detalle-item">
                            <span class="label">Comentarios:</span>
                            <span class="valor"><?php echo htmlspecialchars($datos_reserva['mensaje']); ?></span>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="resumen-usuario">
                    <h2>Datos del Titular</h2>
                    <div class="detalle-item">
                        <span class="label">Nombre:</span>
                        <span class="valor"><?php echo htmlspecialchars($usuario['usuario']); ?></span>
                    </div>
                    <div class="detalle-item">
                        <span class="label">Email:</span>
                        <span class="valor"><?php echo htmlspecialchars($usuario['email']); ?></span>
                    </div>
                    <div class="detalle-item">
                        <span class="label">Teléfono:</span>
                        <span
                            class="valor"><?php echo htmlspecialchars($usuario['telefono'] ?? 'No especificado'); ?></span>
                    </div>
                </div>

                <div class="resumen-total">
                    <?php
                    $num_personas = $datos_reserva['num_personas'];
                    $precio_unitario = $experiencia['precio'];
                    $total = $num_personas * $precio_unitario;
                    ?>
                    <div class="total-item">
                        <span><?php echo $num_personas; ?> persona(s) × S/
                            <?php echo number_format($precio_unitario, 2); ?></span>
                        <span>S/ <?php echo number_format($total, 2); ?></span>
                    </div>
                    <div class="total-final">
                        <span>Total a Pagar:</span>
                        <span class="monto-total">S/ <?php echo number_format($total, 2); ?></span>
                    </div>
                </div>
            </div>

            <form method="POST" action="reservas.php?action=pagar">
                <input type="hidden" name="fecha_reserva" value="<?php echo $datos_reserva['fecha_reserva']; ?>">
                <input type="hidden" name="hora_reserva" value="<?php echo $datos_reserva['hora_reserva']; ?>">
                <input type="hidden" name="num_personas" value="<?php echo $datos_reserva['num_personas']; ?>">
                <input type="hidden" name="mensaje"
                    value="<?php echo htmlspecialchars($datos_reserva['mensaje'] ?? ''); ?>">

                <div class="botones-accion">
                    <a href="reservas.php?action=seleccionar&id=<?php echo $experiencia['id']; ?>"
                        class="btn-secundario">Modificar</a>
                    <button type="submit" class="btn-pagar">Proceder al Pago</button>
                </div>
            </form>
        </div>
    </section>
</main>

<?php include RUTA_VISTAS . 'plantillas/pie.php'; ?>