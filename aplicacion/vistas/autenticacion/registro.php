<?php include RUTA_VISTAS . 'plantillas/encabezado.php'; ?>
<?php include RUTA_VISTAS . 'plantillas/navegacion.php'; ?>

<main>
    <section class="seccion-auth">
        <div class="auth-container">
            <div class="auth-box">
                <h1>Crear Cuenta</h1>
                <p class="subtitulo">Regístrate para completar tu reserva</p>

                <?php if (!empty($mensaje)): ?>
                    <div class="mensaje <?php echo $tipo_mensaje; ?>">
                        <?php echo htmlspecialchars($mensaje); ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="registro.php" class="form-auth" id="formRegistro">
                    <div class="form-group">
                        <label for="nombre">Nombre Completo *</label>
                        <input type="text" id="nombre" name="nombre" required placeholder="Tu nombre completo">
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electrónico *</label>
                        <input type="email" id="email" name="email" required placeholder="tu@email.com"
                            autocomplete="email">
                    </div>

                    <div class="form-group">
                        <label for="telefono">Teléfono *</label>
                        <input type="tel" id="telefono" name="telefono" required placeholder="+51 999 999 999">
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña *</label>
                        <input type="password" id="password" name="password" required placeholder="Mínimo 6 caracteres"
                            minlength="6">
                    </div>

                    <div class="form-group">
                        <label for="password_confirm">Confirmar Contraseña *</label>
                        <input type="password" id="password_confirm" name="password_confirm" required
                            placeholder="Repite tu contraseña" minlength="6">
                    </div>

                    <button type="submit" class="btn-auth">Crear Cuenta</button>
                </form>

                <div class="auth-footer">
                    <p>¿Ya tienes cuenta? <a href="login.php">Iniciar sesión</a></p>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
    // Validar que las contraseñas coincidan
    document.getElementById('formRegistro').addEventListener('submit', function (e) {
        const password = document.getElementById('password').value;
        const passwordConfirm = document.getElementById('password_confirm').value;

        if (password !== passwordConfirm) {
            e.preventDefault();
            alert('Las contraseñas no coinciden');
        }
    });
</script>

<?php include RUTA_VISTAS . 'plantillas/pie.php'; ?>