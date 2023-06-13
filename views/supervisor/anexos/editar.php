<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<div class="dashboard__contenedor-boton">
    <a href="/supervisor/anexos" class="dashboard__boton">
        <i class="fa-solid fa-arrow-left"></i>
        Volver
    </a>
</div>

<div class="dashboard__formulario">
    <?php 
        include __DIR__ . '/../../templates/alertas.php';
    ?>
    <form method="POST" class="formulario">
    <fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información del anexo</legend>

    <div class="formulario__campo">
        <label for="anexo" class="formulario__label">Anexo</label>
        <input
        type="text"
        class="formulario__input"
        id="anexo"
        name="anexo"
        placeholder="Ej: 1234"
        value="<?php echo $anexo->anexo ?? ''; ?>"
        disabled
        >
        <label for="troncal" class="formulario__label">Seleccionar área</label>
        <select
            class="formulario__select"
            id="troncal"
            name="area_id"
            required>
            <?php foreach ($areas as $area): ?>
                <option value="<?php echo $area->id; ?>"><?php echo $area->nombre_area; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</fieldset>
        <input class="formulario__submit formulario__submit--registrar" type="submit" onclick="return actualizar()" value="Actualizar anexo">
    </form>
</div>