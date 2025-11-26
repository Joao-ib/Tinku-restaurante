<?php include RUTA_VISTAS . 'plantillas/encabezado.php'; ?>
<?php include RUTA_VISTAS . 'plantillas/navegacion.php'; ?>

<main>
    <section class="seccion-pago">
        <div class="pago-container">
            <div class="pago-info">
                <h1>Pago Seguro</h1>

                <div class="resumen-pago">
                    <h3><?php echo htmlspecialchars($experiencia['nombre']); ?></h3>
                    <p><?php echo $datos_reserva['num_personas']; ?> persona(s) •
                        <?php echo date('d/m/Y', strtotime($datos_reserva['fecha_reserva'])); ?> •
                        <?php echo $datos_reserva['hora_reserva']; ?></p>

                    <?php
                    $total = $datos_reserva['num_personas'] * $experiencia['precio'];
                    ?>
                    <div class="total-pago">
                        <span>Total:</span>
                        <span class="monto">S/ <?php echo number_format($total, 2); ?></span>
                    </div>
                </div>

                <div class="metodos-pago">
                    <h3>Método de Pago</h3>
                    <div class="metodo-seleccionado">
                        <span>💳</span>
                        <span>Tarjeta de Crédito/Débito</span>
                    </div>
                    <div class="tarjetas-aceptadas">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/0/04/Visa.svg" alt="Visa"
                            style="height: 20px;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg"
                            alt="Mastercard" style="height: 20px;">
                    </div>
                </div>
            </div>

            <div class="pago-formulario">
                <form method="POST" action="reservas.php?action=procesar" id="formPago">
                    <input type="hidden" name="metodo_pago" value="tarjeta">

                    <div class="form-group">
                        <label for="numero_tarjeta">Número de Tarjeta *</label>
                        <input type="text" id="numero_tarjeta" name="numero_tarjeta" required
                            placeholder="1234 5678 9012 3456" maxlength="19" pattern="[0-9\s]{13,19}">
                        <small class="ayuda">Ingresa los 16 dígitos de tu tarjeta</small>
                    </div>

                    <div class="form-group">
                        <label for="nombre_titular">Nombre del Titular *</label>
                        <input type="text" id="nombre_titular" name="nombre_titular" required
                            placeholder="Como aparece en la tarjeta" pattern="[A-Za-z\s]+">
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="fecha_expiracion">Fecha de Expiración *</label>
                            <input type="text" id="fecha_expiracion" name="fecha_expiracion" required
                                placeholder="MM/AA" maxlength="5" pattern="(0[1-9]|1[0-2])\/[0-9]{2}">
                        </div>

                        <div class="form-group">
                            <label for="cvv">CVV *</label>
                            <input type="text" id="cvv" name="cvv" required placeholder="123" maxlength="4"
                                pattern="[0-9]{3,4}">
                            <small class="ayuda">3 o 4 dígitos</small>
                        </div>
                    </div>

                    <div class="seguridad-info">
                        <span>🔒</span>
                        <p>Tu información está protegida con encriptación SSL</p>
                    </div>

                    <button type="submit" class="btn-pagar-final" id="btnPagar">
                        Pagar S/ <?php echo number_format($total, 2); ?>
                    </button>

                    <p class="terminos">
                        Al completar el pago, aceptas nuestros
                        <a href="#">términos y condiciones</a>
                    </p>
                </form>
            </div>
        </div>
    </section>
</main>

<script>
    // Formatear número de tarjeta
    document.getElementById('numero_tarjeta').addEventListener('input', function (e) {
        let value = e.target.value.replace(/\s/g, '');
        let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
        e.target.value = formattedValue;
    });

    // Formatear fecha de expiración
    document.getElementById('fecha_expiracion').addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length >= 2) {
            value = value.slice(0, 2) + '/' + value.slice(2, 4);
        }
        e.target.value = value;
    });

    // Solo números en CVV
    document.getElementById('cvv').addEventListener('input', function (e) {
        e.target.value = e.target.value.replace(/\D/g, '');
    });

    // Validación del formulario
    document.getElementById('formPago').addEventListener('submit', function (e) {
        const numeroTarjeta = document.getElementById('numero_tarjeta').value.replace(/\s/g, '');
        const fechaExp = document.getElementById('fecha_expiracion').value;
        const cvv = document.getElementById('cvv').value;

        // Validar longitud de tarjeta (13-19 dígitos)
        if (numeroTarjeta.length < 13 || numeroTarjeta.length > 19) {
            e.preventDefault();
            alert('Número de tarjeta inválido');
            return;
        }

        // Validar formato de fecha
        if (!/^(0[1-9]|1[0-2])\/[0-9]{2}$/.test(fechaExp)) {
            e.preventDefault();
            alert('Fecha de expiración inválida. Formato: MM/AA');
            return;
        }

        // Validar que la fecha no esté vencida
        const [mes, año] = fechaExp.split('/');
        const fechaActual = new Date();
        const mesActual = fechaActual.getMonth() + 1;
        const añoActual = parseInt(fechaActual.getFullYear().toString().slice(-2));

        if (parseInt(año) < añoActual || (parseInt(año) === añoActual && parseInt(mes) < mesActual)) {
            e.preventDefault();
            alert('La tarjeta está vencida');
            return;
        }

        // Validar CVV
        if (cvv.length < 3 || cvv.length > 4) {
            e.preventDefault();
            alert('CVV inválido');
            return;
        }

        // Mostrar loading
        document.getElementById('btnPagar').disabled = true;
        document.getElementById('btnPagar').textContent = 'Procesando...';
    });
</script>

<?php include RUTA_VISTAS . 'plantillas/pie.php'; ?>