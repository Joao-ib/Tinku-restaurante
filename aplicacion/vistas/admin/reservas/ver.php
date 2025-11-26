<div class="table-header" style="margin-bottom: 25px;">
    <div>
        <h2>Detalle de Reserva #<?php echo $reserva['codigo_confirmacion']; ?></h2>
        <p style="color: #7f8c8d; font-size: 14px; margin-top: 5px;">
            Creada el <?php echo date('d/m/Y H:i', strtotime($reserva['fecha_creacion'])); ?>
        </p>
    </div>
    <a href="admin.php?module=reservas" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Volver
    </a>
</div>

<div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 25px;">
    <!-- Información de la Reserva -->
    <div class="table-container">
        <div class="table-header">
            <h3>Información de la Reserva</h3>
        </div>
        <div style="padding: 25px;">
            <div style="margin-bottom: 20px;">
                <strong style="color: #7f8c8d; display: block; margin-bottom: 5px;">Experiencia:</strong>
                <span style="font-size: 18px;"><?php echo htmlspecialchars($reserva['experiencia_nombre']); ?></span>
                <span class="badge badge-info"
                    style="margin-left: 10px;"><?php echo htmlspecialchars($reserva['region']); ?></span>
            </div>

            <div style="margin-bottom: 15px;">
                <strong style="color: #7f8c8d;">Fecha:</strong>
                <?php echo date('d/m/Y', strtotime($reserva['fecha_reserva'])); ?>
            </div>

            <div style="margin-bottom: 15px;">
                <strong style="color: #7f8c8d;">Hora:</strong>
                <?php echo $reserva['hora_reserva']; ?>
            </div>

            <div style="margin-bottom: 15px;">
                <strong style="color: #7f8c8d;">Número de Personas:</strong>
                <?php echo $reserva['num_personas']; ?>
            </div>

            <?php if ($reserva['mensaje']): ?>
                <div style="margin-top: 20px; padding: 15px; background: #f8f9fa; border-radius: 6px;">
                    <strong style="color: #7f8c8d; display: block; margin-bottom: 8px;">Comentarios:</strong>
                    <?php echo htmlspecialchars($reserva['mensaje']); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Información del Usuario -->
    <div class="table-container">
        <div class="table-header">
            <h3>Datos del Cliente</h3>
        </div>
        <div style="padding: 25px;">
            <div style="margin-bottom: 15px;">
                <strong style="color: #7f8c8d;">Nombre:</strong>
                <?php echo htmlspecialchars($reserva['usuario_nombre'] ?? $reserva['nombre']); ?>
            </div>

            <div style="margin-bottom: 15px;">
                <strong style="color: #7f8c8d;">Email:</strong>
                <?php echo htmlspecialchars($reserva['usuario_email'] ?? $reserva['email']); ?>
            </div>

            <div style="margin-bottom: 15px;">
                <strong style="color: #7f8c8d;">Teléfono:</strong>
                <?php echo htmlspecialchars($reserva['usuario_telefono'] ?? $reserva['telefono']); ?>
            </div>
        </div>
    </div>

    <!-- Información de Pago -->
    <div class="table-container">
        <div class="table-header">
            <h3>Información de Pago</h3>
        </div>
        <div style="padding: 25px;">
            <div style="margin-bottom: 15px;">
                <strong style="color: #7f8c8d;">Método de Pago:</strong>
                <?php echo ucfirst($reserva['metodo_pago']); ?>
            </div>

            <div style="margin-bottom: 15px;">
                <strong style="color: #7f8c8d;">Precio por Persona:</strong>
                S/ <?php echo number_format($reserva['precio_unitario'], 2); ?>
            </div>

            <div style="margin-bottom: 15px;">
                <strong style="color: #7f8c8d;">Monto Total:</strong>
                <span style="font-size: 24px; color: #667eea; font-weight: 600;">
                    S/ <?php echo number_format($reserva['monto_total'], 2); ?>
                </span>
            </div>

            <div style="margin-top: 20px;">
                <strong style="color: #7f8c8d; display: block; margin-bottom: 10px;">Estado:</strong>
                <?php if ($reserva['estado_pago'] == 'confirmado'): ?>
                    <span class="badge badge-success" style="font-size: 14px; padding: 8px 16px;">Confirmado</span>
                <?php elseif ($reserva['estado_pago'] == 'cancelado'): ?>
                    <span class="badge badge-danger" style="font-size: 14px; padding: 8px 16px;">Cancelado</span>
                <?php else: ?>
                    <span class="badge badge-warning" style="font-size: 14px; padding: 8px 16px;">Pendiente</span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Acciones -->
    <div class="table-container">
        <div class="table-header">
            <h3>Acciones</h3>
        </div>
        <div style="padding: 25px;">
            <?php if ($reserva['estado_pago'] != 'cancelado'): ?>
                <div style="margin-bottom: 15px;">
                    <strong style="display: block; margin-bottom: 10px;">Cambiar Estado:</strong>
                    <div style="display: flex; gap: 10px;">
                        <?php if ($reserva['estado_pago'] != 'confirmado'): ?>
                            <a href="admin.php?module=reservas&action=cambiarEstado&id=<?php echo $reserva['id']; ?>&estado=confirmado"
                                class="btn btn-success btn-sm" onclick="return confirm('¿Confirmar esta reserva?');">
                                Confirmar
                            </a>
                        <?php endif; ?>

                        <?php if ($reserva['estado_pago'] != 'pendiente'): ?>
                            <a href="admin.php?module=reservas&action=cambiarEstado&id=<?php echo $reserva['id']; ?>&estado=pendiente"
                                class="btn btn-secondary btn-sm" onclick="return confirm('¿Marcar como pendiente?');">
                                Pendiente
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #ecf0f1;">
                    <a href="admin.php?module=reservas&action=cancelar&id=<?php echo $reserva['id']; ?>"
                        class="btn btn-danger" onclick="return confirm('¿Estás seguro de cancelar esta reserva?');">
                        <i class="fas fa-times-circle"></i> Cancelar Reserva
                    </a>
                </div>
            <?php else: ?>
                <p style="color: #e74c3c;">Esta reserva ha sido cancelada</p>
            <?php endif; ?>
        </div>
    </div>
</div>