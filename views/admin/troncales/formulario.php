<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información del troncal</legend>

    <div class="formulario__campo">
        <label for="troncal" class="formulario__label">Número de troncal</label>
        <input
        type="number"
        class="formulario__input"
        id="troncal"
        name="troncal"
        value="<?php echo $troncal->troncal ?? ''; ?>"
        required
        >
        <label for="compania" class="formulario__label">Seleccionar área</label>
        <select
            class="formulario__select"
            id="compania"
            name="compania_id"
            required>
            <?php foreach ($companias as $compania): ?>
                <option value="<?php echo $compania->id; ?>"><?php echo $compania->nombre_compania; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</fieldset>