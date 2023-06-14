<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<div class="dashboard__contenedor-boton">
    <a href="/admin/troncales" class="dashboard__boton">
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
    <legend class="formulario__legend">Información del troncal</legend>

    <div class="formulario__campo">
        <label for="troncal" class="formulario__label">Troncal</label>
        <input
        type="text"
        class="formulario__input"
        id="troncal"
        name="troncal"
        placeholder="Ej: 1234"
        value="<?php echo $troncal->troncal ?? ''; ?>"
        disabled
        >
        <label for="compania" class="formulario__label">Seleccionar compañia</label>
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
        <input class="formulario__submit formulario__submit--registrar" type="submit" onclick="return actualizar()" value="Actualizar troncal">
    </form>
</div>