<div class="table-header" style="margin-bottom: 25px;">
    <div>
        <h2>Gestión de Experiencias</h2>
        <p style="color: #7f8c8d; font-size: 14px; margin-top: 5px;">
            Administra las experiencias gastronómicas del restaurante
        </p>
    </div>
    <a href="admin.php?module=experiencias&action=crear" class="btn btn-primary">
        <i class="fas fa-plus"></i> Nueva Experiencia
    </a>
</div>

<!-- Filtros -->
<div class="table-container" style="margin-bottom: 20px;">
    <div style="padding: 20px;">
        <form method="GET" action="admin.php" style="display: flex; gap: 15px; flex-wrap: wrap;">
            <input type="hidden" name="module" value="experiencias">

            <div style="flex: 1; min-width: 200px;">
                <input type="text" name="busqueda" placeholder="Buscar por nombre..."
                    value="<?php echo htmlspecialchars($_GET['busqueda'] ?? ''); ?>"
                    style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px;">
            </div>

            <select name="region" style="padding: 10px; border: 1px solid #ddd; border-radius: 6px;">
                <option value="">Todas las regiones</option>
                <option value="Costa" <?php echo (($_GET['region'] ?? '') == 'Costa' ? 'selected' : ''); ?>>Costa</option>
                <option value="Sierra" <?php echo (($_GET['region'] ?? '') == 'Sierra' ? 'selected' : ''); ?>>Sierra
                </option>
                <option value="Selva" <?php echo (($_GET['region'] ?? '') == 'Selva' ? 'selected' : ''); ?>>Selva</option>
            </select>

            <select name="estado" style="padding: 10px; border: 1px solid #ddd; border-radius: 6px;">
                <option value="">Todos los estados</option>
                <option value="1" <?php echo (($_GET['estado'] ?? '') === '1' ? 'selected' : ''); ?>>Activas</option>
                <option value="0" <?php echo (($_GET['estado'] ?? '') === '0' ? 'selected' : ''); ?>>Inactivas</option>
            </select>

            <button type="submit" class="btn btn-secondary">
                <i class="fas fa-search"></i> Filtrar
            </button>

            <a href="admin.php?module=experiencias" class="btn btn-secondary">
                <i class="fas fa-times"></i> Limpiar
            </a>
        </form>
    </div>
</div>

<!-- Tabla de experiencias -->
<div class="table-container">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Región</th>
                    <th>Precio</th>
                    <th>Duración</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($experiencias)): ?>
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 40px; color: #7f8c8d;">
                            <i class="fas fa-inbox" style="font-size: 48px; margin-bottom: 15px; display: block;"></i>
                            No se encontraron experiencias
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($experiencias as $exp): ?>
                        <tr>
                            <td><strong>#<?php echo $exp['id']; ?></strong></td>
                            <td>
                                <img src="<?php echo htmlspecialchars($exp['imagen']); ?>"
                                    alt="<?php echo htmlspecialchars($exp['nombre']); ?>"
                                    style="width: 60px; height: 40px; object-fit: cover; border-radius: 6px;"
                                    onerror="this.src='publico/imagenes/placeholder.jpg'">
                            </td>
                            <td>
                                <strong><?php echo htmlspecialchars($exp['nombre']); ?></strong>
                                <br>
                                <small style="color: #7f8c8d;">
                                    <?php echo htmlspecialchars(substr($exp['descripcion_corta'], 0, 50)); ?>...
                                </small>
                            </td>
                            <td>
                                <span class="badge badge-info">
                                    <?php echo htmlspecialchars($exp['region']); ?>
                                </span>
                            </td>
                            <td>
                                <strong>S/ <?php echo number_format($exp['precio'], 2); ?></strong>
                            </td>
                            <td><?php echo htmlspecialchars($exp['duracion']); ?></td>
                            <td>
                                <?php if ($exp['disponible']): ?>
                                    <span class="badge badge-success">Activa</span>
                                <?php else: ?>
                                    <span class="badge badge-danger">Inactiva</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div style="display: flex; gap: 5px;">
                                    <a href="admin.php?module=experiencias&action=editar&id=<?php echo $exp['id']; ?>"
                                        class="btn btn-sm btn-secondary" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a href="admin.php?module=experiencias&action=toggle&id=<?php echo $exp['id']; ?>"
                                        class="btn btn-sm <?php echo $exp['disponible'] ? 'btn-warning' : 'btn-success'; ?>"
                                        title="<?php echo $exp['disponible'] ? 'Desactivar' : 'Activar'; ?>"
                                        onclick="return confirm('¿Cambiar estado de esta experiencia?');">
                                        <i class="fas fa-<?php echo $exp['disponible'] ? 'eye-slash' : 'eye'; ?>"></i>
                                    </a>

                                    <a href="admin.php?module=experiencias&action=eliminar&id=<?php echo $exp['id']; ?>"
                                        class="btn btn-sm btn-danger" title="Eliminar"
                                        onclick="return confirm('¿Estás seguro de eliminar esta experiencia? Esta acción no se puede deshacer.');">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>