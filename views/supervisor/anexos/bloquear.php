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
                <label 
                for="anexo" 
                class="formulario__label">Anexo</label>

                <input 
                type="text" 
                class="formulario__input" 
                id="anexo" 
                name="anexo" 
                placeholder="Ej: 1234" 
                value="<?php echo $anexo->anexo ?? ''; ?>"
                disabled>

                <label
                for="troncal" 
                class="formulario__label">Área</label>

                <select
                class="formulario__select" 
                id="area" 
                name="area_id" 
                disabled>
                    <?php foreach ($areas as $area) : ?>
                        <option value="<?php echo $area->id; ?>"><?php echo $area->nombre_area; ?></option>
                    <?php endforeach; ?>
                </select>

                <label
                for="fecha" 
                class="formulario__label">Fecha de bloqueo</label>

                <input 
                type="datetime-local" 
                class="formulario__input" 
                id="fecha" 
                name="fecha" 
                value="<?php echo date('Y-m-d\TH:i:s'); ?>" 
                >

                <label
                for="estado_anexo" 
                class="formulario__label">Estado</label>

                <select 
                class="formulario__select" 
                id="estado_anexo" 
                name="estado_anexo_id" 
                required>
                <option value="2">Bloqueado</option>
                </select>

                <label for="mensaje" class="formulario__label">Mensaje</label>
                <input 
                type="text" 
                class="formulario__input" 
                id="mensaje" 
                name="mensaje" 
                placeholder="Ej: Anexo bloqueado por falta de pago" 
                value=""
                >
                <label for="bloqueado" class="formulario__label">Responsable</label>
                    <select 
                    class="formulario__select" 
                    id="bloqueado" 
                    name="bloqueado"
                    >
                    <option value="<?php echo $_SESSION['id'] ; ?>"><?php echo $_SESSION['nombre'] .' '. $_SESSION['apellido'] ; ?></option>
                    </select>

            </div>
        </fieldset>
        <input class="formulario__submit formulario__submit--registrar" type="submit" onclick="return bloquear()" value="Bloquear anexo">
    </form>
</div>