<div class="table-header" style="margin-bottom: 25px;">
    <div>
        <h2>Gestión de Reservas</h2>
        <p style="color: #7f8c8d; font-size: 14px; margin-top: 5px;">
            Administra todas las reservas del restaurante
        </p>
    </div>
    <a href="admin.php?module=reservas&action=exportar<?php echo (isset($_GET['fecha_desde']) ? '&fecha_desde=' . $_GET['fecha_desde'] : ''); ?><?php echo (isset($_GET['fecha_hasta']) ? '&fecha_hasta=' . $_GET['fecha_hasta'] : ''); ?>"
        class="btn btn-success">
        <i class="fas fa-download"></i> Exportar CSV
    </a>
</div>

<!-- Filtros -->
<div class="table-container" style="margin-bottom: 20px;">
    <div style="padding: 20px;">
        <form method="GET" action="admin.php" style="display: flex; gap: 15px; flex-wrap: wrap;">
            <input type="hidden" name="module" value="reservas">

            <div style="flex: 1; min-width: 200px;">
                <input type="text" name="busqueda" placeholder="Buscar por código, nombre o email..."
                    value="<?php echo htmlspecialchars($_GET['busqueda'] ?? ''); ?>"
                    style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px;">
            </div>

            <input type="date" name="fecha_desde" value="<?php echo $_GET['fecha_desde'] ?? ''; ?>"
                style="padding: 10px; border: 1px solid #ddd; border-radius: 6px;" placeholder="Desde">

            <input type="date" name="fecha_hasta" value="<?php echo $_GET['fecha_hasta'] ?? ''; ?>"
                style="padding: 10px; border: 1px solid #ddd; border-radius: 6px;" placeholder="Hasta">

            <select name="experiencia_id" style="padding: 10px; border: 1px solid #ddd; border-radius: 6px;">
                <option value="">Todas las experiencias</option>
                <?php foreach ($experiencias as $exp): ?>
                    <option value="<?php echo $exp['id']; ?>" <?php echo (($_GET['experiencia_id'] ?? '') == $exp['id'] ? 'selected' : ''); ?>>
                        <?php echo htmlspecialchars($exp['nombre']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <select name="estado" style="padding: 10px; border: 1px solid #ddd; border-radius: 6px;">
                <option value="">Todos los estados</option>
                <option value="confirmado" <?php echo (($_GET['estado'] ?? '') == 'confirmado' ? 'selected' : ''); ?>>
                    Confirmado</option>
                <option value="pendiente" <?php echo (($_GET['estado'] ?? '') == 'pendiente' ? 'selected' : ''); ?>>
                    Pendiente</option>
                <option value="cancelado" <?php echo (($_GET['estado'] ?? '') == 'cancelado' ? 'selected' : ''); ?>>
                    Cancelado</option>
            </select>

            <button type="submit" class="btn btn-secondary">
                <i class="fas fa-search"></i> Filtrar
            </button>

            <a href="admin.php?module=reservas" class="btn btn-secondary">
                <i class="fas fa-times"></i> Limpiar
            </a>
        </form>
    </div>
</div>

<!-- Tabla de reservas -->
<div class="table-container">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Usuario</th>
                    <th>Experiencia</th>
                    <th>Fecha</th>
                    <th>Personas</th>
                    <th>Monto</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($reservas)): ?>
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 40px; color: #7f8c8d;">
                            <i class="fas fa-calendar-times"
                                style="font-size: 48px; margin-bottom: 15px; display: block;"></i>
                            No se encontraron reservas
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($reservas as $reserva): ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($reserva['codigo_confirmacion']); ?></strong></td>
                            <td><?php echo htmlspecialchars($reserva['usuario_nombre'] ?? $reserva['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($reserva['experiencia_nombre']); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($reserva['fecha_reserva'])); ?>
                                <?php echo $reserva['hora_reserva']; ?></td>
                            <td><?php echo $reserva['num_personas']; ?></td>
                            <td><strong>S/ <?php echo number_format($reserva['monto_total'], 2); ?></strong></td>
                            <td>
                                <?php if ($reserva['estado_pago'] == 'confirmado'): ?>
                                    <span class="badge badge-success">Confirmado</span>
                                <?php elseif ($reserva['estado_pago'] == 'cancelado'): ?>
                                    <span class="badge badge-danger">Cancelado</span>
                                <?php else: ?>
                                    <span class="badge badge-warning">Pendiente</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="admin.php?module=reservas&action=ver&id=<?php echo $reserva['id']; ?>"
                                    class="btn btn-sm btn-secondary" title="Ver detalle">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>