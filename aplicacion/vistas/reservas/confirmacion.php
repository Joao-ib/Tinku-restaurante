<?php include RUTA_VISTAS . 'plantillas/encabezado.php'; ?>
<?php include RUTA_VISTAS . 'plantillas/navegacion.php'; ?>

<main>
    <section class="seccion-confirmacion">
        <div class="confirmacion-container">
            <div class="confirmacion-exito">
                <div class="icono-exito">✓</div>
                <h1>¡Reserva Confirmada!</h1>
                <p class="mensaje-exito">Tu pago ha sido procesado exitosamente</p>

                <div class="codigo-confirmacion">
                    <span class="label">Código de Confirmación</span>
                    <span class="codigo"><?php echo htmlspecialchars($reserva['codigo_confirmacion']); ?></span>
                </div>
            </div>

            <div class="detalles-confirmacion">
                <h2>Detalles de tu Reserva</h2>

                <div class="detalle-box">
                    <h3><?php echo htmlspecialchars($reserva['experiencia_nombre']); ?></h3>
                    <span class="region-tag"><?php echo htmlspecialchars($reserva['region']); ?></span>
                </div>

                <div class="info-grid">
                    <div class="info-item">
                        <span class="icono">📅</span>
                        <div>
                            <strong>Fecha</strong>
                            <p><?php echo date('d/m/Y', strtotime($reserva['fecha_reserva'])); ?></p>
                        </div>
                    </div>

                    <div class="info-item">
                        <span class="icono">🕐</span>
                        <div>
                            <strong>Hora</strong>
                            <p><?php echo $reserva['hora_reserva']; ?></p>
                        </div>
                    </div>

                    <div class="info-item">
                        <span class="icono">👥</span>
                        <div>
                            <strong>Personas</strong>
                            <p><?php echo $reserva['num_personas']; ?> persona(s)</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <span class="icono">💰</span>
                        <div>
                            <strong>Total Pagado</strong>
                            <p>S/ <?php echo number_format($reserva['monto_total'], 2); ?></p>
                        </div>
                    </div>
                </div>

                <div class="datos-titular">
                    <h3>Datos del Titular</h3>
                    <p><strong>Nombre:</strong> <?php echo htmlspecialchars($reserva['nombre']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($reserva['email']); ?></p>
                    <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($reserva['telefono']); ?></p>
                </div>
            </div>

            <div class="proximos-pasos">
                <h3>Próximos Pasos</h3>
                <ul>
                    <li>✉️ Recibirás un email de confirmación en los próximos minutos</li>
                    <li>📱 Te enviaremos un recordatorio 24 horas antes de tu reserva</li>
                    <li>🍽️ Presenta tu código de confirmación al llegar al restaurante</li>
                </ul>
            </div>

            <div class="acciones-confirmacion">
                <button onclick="window.print()" class="btn-secundario">
                    🖨️ Imprimir Comprobante
                </button>
                <a href="index.php" class="btn-principal">
                    Volver al Inicio
                </a>
            </div>

            <div class="info-adicional">
                <h4>Información Importante</h4>
                <p>📍 <strong>Ubicación:</strong> Av. Principal 123, Miraflores, Lima</p>
                <p>⏰ <strong>Llegada:</strong> Por favor llega 10 minutos antes de tu reserva</p>
                <p>📞 <strong>Contacto:</strong> +51 999 999 999</p>
                <p>🔄 <strong>Cancelaciones:</strong> Puedes cancelar hasta 24 horas antes sin cargo</p>
            </div>
        </div>
    </section>
</main>

<style>
    @media print {

        header,
        footer,
        .acciones-confirmacion,
        .proximos-pasos {
            display: none !important;
        }

        .confirmacion-container {
            padding: 20px;
        }
    }
</style>

<?php include RUTA_VISTAS . 'plantillas/pie.php'; ?>