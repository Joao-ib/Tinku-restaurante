<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-value"><?php echo number_format($metricas['reservas_hoy']); ?></div>
                <div class="stat-label">Reservas Hoy</div>
            </div>
            <div class="stat-icon purple">
                <i class="fas fa-calendar-day"></i>
            </div>
        </div>
        <small style="color: #7f8c8d;">
            <?php echo number_format($metricas['reservas_semana']); ?> esta semana •
            <?php echo number_format($metricas['reservas_mes']); ?> este mes
        </small>
    </div>

    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-value">S/ <?php echo number_format($metricas['ingresos_mes'], 2); ?></div>
                <div class="stat-label">Ingresos del Mes</div>
            </div>
            <div class="stat-icon green">
                <i class="fas fa-dollar-sign"></i>
            </div>
        </div>
        <small style="color: #7f8c8d;">
            Total: S/ <?php echo number_format($metricas['ingresos_totales'], 2); ?>
        </small>
    </div>

    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-value"><?php echo $metricas['experiencias_activas']; ?></div>
                <div class="stat-label">Experiencias Activas</div>
            </div>
            <div class="stat-icon orange">
                <i class="fas fa-utensils"></i>
            </div>
        </div>
        <small style="color: #7f8c8d;">
            <?php echo $metricas['total_experiencias']; ?> en total
        </small>
    </div>

    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-value"><?php echo number_format($metricas['total_usuarios']); ?></div>
                <div class="stat-label">Usuarios Registrados</div>
            </div>
            <div class="stat-icon blue">
                <i class="fas fa-users"></i>
            </div>
        </div>
        <small style="color: #7f8c8d;">
            <?php echo $metricas['usuarios_mes']; ?> nuevos este mes
        </small>
    </div>
</div>

<div class="table-container" style="margin-bottom: 30px;">
    <div class="table-header">
        <h2>Experiencias Más Populares</h2>
    </div>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Experiencia</th>
                    <th>Región</th>
                    <th>Total Reservas</th>
                    <th>Ingresos</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($experienciasPopulares)): ?>
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 30px; color: #7f8c8d;">
                            No hay datos disponibles
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($experienciasPopulares as $exp): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($exp['nombre']); ?></td>
                            <td>
                                <span class="badge badge-info">
                                    <?php echo htmlspecialchars($exp['region']); ?>
                                </span>
                            </td>
                            <td><?php echo number_format($exp['total_reservas']); ?></td>
                            <td>S/ <?php echo number_format($exp['ingresos'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="table-container">
    <div class="table-header">
        <h2>Reservas Recientes</h2>
        <a href="admin.php?module=reservas" class="btn btn-primary btn-sm">Ver Todas</a>
    </div>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Usuario</th>
                    <th>Experiencia</th>
                    <th>Fecha Reserva</th>
                    <th>Personas</th>
                    <th>Monto</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($reservasRecientes)): ?>
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 30px; color: #7f8c8d;">
                            No hay reservas aún
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($reservasRecientes as $reserva): ?>
                        <tr>
                            <td>
                                <strong><?php echo htmlspecialchars($reserva['codigo_confirmacion']); ?></strong>
                            </td>
                            <td><?php echo htmlspecialchars($reserva['usuario_nombre'] ?? $reserva['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($reserva['experiencia_nombre']); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($reserva['fecha_reserva'])); ?></td>
                            <td><?php echo $reserva['num_personas']; ?></td>
                            <td>S/ <?php echo number_format($reserva['monto_total'], 2); ?></td>
                            <td>
                                <?php if ($reserva['estado_pago'] == 'confirmado'): ?>
                                    <span class="badge badge-success">Confirmado</span>
                                <?php else: ?>
                                    <span class="badge badge-warning">Pendiente</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>