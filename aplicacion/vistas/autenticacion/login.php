<?php include RUTA_VISTAS . 'plantillas/encabezado.php'; ?>
<?php include RUTA_VISTAS . 'plantillas/navegacion.php'; ?>

<main>
    <section class="seccion-auth">
        <div class="auth-container">
            <div class="auth-box">
                <h1>Iniciar Sesión</h1>
                <p class="subtitulo">Accede a tu cuenta para continuar con tu reserva</p>

                <?php if (!empty($mensaje)): ?>
                    <div class="mensaje <?php echo $tipo_mensaje; ?>">
                        <?php echo htmlspecialchars($mensaje); ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="login.php" class="form-auth">
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" id="email" name="email" required placeholder="tu@email.com"
                            autocomplete="email">
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" required placeholder="••••••••"
                            autocomplete="current-password">
                    </div>

                    <button type="submit" class="btn-auth">Iniciar Sesión</button>
                </form>

                <div class="auth-footer">
                    <p>¿No tienes una cuenta? <a href="registro.php">Crear cuenta</a></p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include RUTA_VISTAS . 'plantillas/pie.php'; ?>