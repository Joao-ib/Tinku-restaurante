<div class="table-header" style="margin-bottom: 25px;">
    <div>
        <h2>Editar Experiencia</h2>
        <p style="color: #7f8c8d; font-size: 14px; margin-top: 5px;">
            Modifica la información de la experiencia
        </p>
    </div>
    <a href="admin.php?module=experiencias" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Volver
    </a>
</div>

<div class="table-container">
    <div style="padding: 30px;">
        <form method="POST" enctype="multipart/form-data" id="formExperiencia">
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 25px; margin-bottom: 25px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                        Nombre de la Experiencia *
                    </label>
                    <input type="text" name="nombre" required 
                           value="<?php echo htmlspecialchars($experiencia['nombre']); ?>"
                           style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px;">
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                        Región *
                    </label>
                    <select name="region" required 
                            style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px;">
                        <option value="">Selecciona una región</option>
                        <option value="Costa" <?php echo ($experiencia['region'] == 'Costa' ? 'selected' : ''); ?>>Costa</option>
                        <option value="Sierra" <?php echo ($experiencia['region'] == 'Sierra' ? 'selected' : ''); ?>>Sierra</option>
                        <option value="Selva" <?php echo ($experiencia['region'] == 'Selva' ? 'selected' : ''); ?>>Selva</option>
                    </select>
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                        Precio (S/) *
                    </label>
                    <input type="number" name="precio" required step="0.01" min="0"
                           value="<?php echo $experiencia['precio']; ?>"
                           style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px;">
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                        Duración *
                    </label>
                    <input type="text" name="duracion" required 
                           value="<?php echo htmlspecialchars($experiencia['duracion']); ?>"
                           style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px;">
                </div>
            </div>

            <div style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                    Descripción Corta *
                </label>
                <textarea name="descripcion_corta" required rows="2"
                          style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; resize: vertical;"><?php echo htmlspecialchars($experiencia['descripcion_corta']); ?></textarea>
            </div>

            <div style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                    Descripción Larga *
                </label>
                <textarea name="descripcion_larga" required rows="5"
                          style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; resize: vertical;"><?php echo htmlspecialchars($experiencia['descripcion_larga']); ?></textarea>
            </div>

            <div style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                    Imagen Actual
                </label>
                <div style="margin-bottom: 15px;">
                    <img src="<?php echo htmlspecialchars($experiencia['imagen']); ?>" 
                         alt="Imagen actual"
                         style="max-width: 300px; height: auto; border-radius: 8px; border: 1px solid #ddd;"
                         onerror="this.src='publico/imagenes/placeholder.jpg'">
                </div>
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50;">
                    Cambiar Imagen (opcional)
                </label>
                <input type="file" name="imagen" accept="image/*"
                       style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px;">
                <small style="color: #7f8c8d; display: block; margin-top: 5px;">
                    Deja vacío si no deseas cambiar la imagen. Formatos: JPG, PNG, WebP. Máx: 2MB
                </small>
            </div>

            <div style="margin-bottom: 25px;">
                <label style="display: flex; align-items: center; cursor: pointer;">
                    <input type="checkbox" name="disponible" <?php echo ($experiencia['disponible'] ? 'checked' : ''); ?>
                           style="width: 20px; height: 20px; margin-right: 10px;">
                    <span style="font-weight: 600; color: #2c3e50;">Experiencia disponible</span>
                </label>
            </div>

            <div style="display: flex; gap: 15px; justify-content: flex-end; padding-top: 20px; border-top: 1px solid #ecf0f1;">
                <a href="admin.php?module=experiencias" class="btn btn-secondary">
                    Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Actualizar Experiencia
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Validar tamaño de archivo
document.getElementById('formExperiencia').addEventListener('submit', function(e) {
    const fileInput = document.querySelector('input[type="file"]');
    if (fileInput.files.length > 0) {
        const fileSize = fileInput.files[0].size / 1024 / 1024; // MB
        if (fileSize > 2) {
            e.preventDefault();
            alert('La imagen es demasiado grande. El tamaño máximo es 2MB.');
            return false;
        }
    }
});
</script>
