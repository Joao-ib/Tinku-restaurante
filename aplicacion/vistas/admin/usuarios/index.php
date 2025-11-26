<div class="table-header" style="margin-bottom: 25px;">
    <div>
        <h2>Gestión de Usuarios</h2>
        <p style="color: #7f8c8d; font-size: 14px; margin-top: 5px;">
            Administra los usuarios y sus roles
        </p>
    </div>
</div>

<!-- Filtros -->
<div class="table-container" style="margin-bottom: 20px;">
    <div style="padding: 20px;">
        <form method="GET" action="admin.php" style="display: flex; gap: 15px; flex-wrap: wrap;">
            <input type="hidden" name="module" value="usuarios">

            <div style="flex: 1; min-width: 250px;">
                <input type="text" name="busqueda" placeholder="Buscar por nombre o email..."
                    value="<?php echo htmlspecialchars($_GET['busqueda'] ?? ''); ?>"
                    style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px;">
            </div>

            <select name="rol" style="padding: 10px; border: 1px solid #ddd; border-radius: 6px;">
                <option value="">Todos los roles</option>
                <option value="usuario" <?php echo (($_GET['rol'] ?? '') == 'usuario' ? 'selected' : ''); ?>>Usuarios
                </option>
                <option value="admin" <?php echo (($_GET['rol'] ?? '') == 'admin' ? 'selected' : ''); ?>>Administradores
                </option>
            </select>

            <button type="submit" class="btn btn-secondary">
                <i class="fas fa-search"></i> Filtrar
            </button>

            <a href="admin.php?module=usuarios" class="btn btn-secondary">
                <i class="fas fa-times"></i> Limpiar
            </a>
        </form>
    </div>
</div>

<!-- Tabla de usuarios -->
<div class="table-container">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Rol</th>
                    <th>Reservas</th>
                    <th>Registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($usuarios)): ?>
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 40px; color: #7f8c8d;">
                            <i class="fas fa-users-slash" style="font-size: 48px; margin-bottom: 15px; display: block;"></i>
                            No se encontraron usuarios
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><strong>#<?php echo $usuario['id']; ?></strong></td>
                            <td><?php echo htmlspecialchars($usuario['usuario']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['telefono'] ?? '-'); ?></td>
                            <td>
                                <?php if ($usuario['rol'] == 'admin'): ?>
                                    <span class="badge"
                                        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                                        Admin
                                    </span>
                                <?php else: ?>
                                    <span class="badge badge-info">Usuario</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="admin.php?module=usuarios&action=historial&id=<?php echo $usuario['id']; ?>">
                                    <?php echo $usuario['total_reservas']; ?> reservas
                                </a>
                            </td>
                            <td><?php echo date('d/m/Y', strtotime($usuario['fecha_registro'])); ?></td>
                            <td>
                                <div style="display: flex; gap: 5px;">
                                    <?php if ($usuario['id'] != $_SESSION['usuario_id']): ?>
                                        <?php if ($usuario['rol'] == 'usuario'): ?>
                                            <a href="admin.php?module=usuarios&action=cambiarRol&id=<?php echo $usuario['id']; ?>&rol=admin"
                                                class="btn btn-sm btn-success" title="Hacer Admin"
                                                onclick="return confirm('¿Convertir a este usuario en administrador?');">
                                                <i class="fas fa-user-shield"></i>
                                            </a>
                                        <?php else: ?>
                                            <a href="admin.php?module=usuarios&action=cambiarRol&id=<?php echo $usuario['id']; ?>&rol=usuario"
                                                class="btn btn-sm btn-warning" title="Quitar Admin"
                                                onclick="return confirm('¿Quitar privilegios de administrador?');">
                                                <i class="fas fa-user"></i>
                                            </a>
                                        <?php endif; ?>

                                        <a href="admin.php?module=usuarios&action=toggle&id=<?php echo $usuario['id']; ?>"
                                            class="btn btn-sm <?php echo ($usuario['activo'] ?? 1) ? 'btn-danger' : 'btn-success'; ?>"
                                            title="<?php echo ($usuario['activo'] ?? 1) ? 'Desactivar' : 'Activar'; ?>"
                                            onclick="return confirm('¿Cambiar estado de este usuario?');">
                                            <i class="fas fa-<?php echo ($usuario['activo'] ?? 1) ? 'ban' : 'check'; ?>"></i>
                                        </a>
                                    <?php else: ?>
                                        <span class="badge badge-info">Tú</span>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>