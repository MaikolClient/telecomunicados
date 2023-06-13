<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información del anexo</legend>

    <div class="formulario__campo">
        <label for="anexo" class="formulario__label">Número de Anexo</label>
        <input
        type="text"
        class="formulario__input"
        id="anexo"
        name="anexo"
        value="<?php echo $anexo->anexo ?? ''; ?>"
        required
        >
        <label for="area" class="formulario__label">Área</label>
        <select
            class="formulario__select"
            id="area"
            name="area_id"
            required>
            <?php foreach ($areas as $area): ?>
                <option value="<?php echo $area->id; ?>"><?php echo $area->nombre_area; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</fieldset>