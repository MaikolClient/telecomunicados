<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<div class="dashboard__contenedor-boton">
    <a href="/supervisor/usuarios" class="dashboard__boton">
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
    <legend class="formulario__legend">Información del usuario</legend>

    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre</label>
        <input
        type="text"
        class="formulario__input"
        id="nombre"
        name="nombre"
        placeholder="Ej: Juan"
        value="<?php echo $usuario->nombre ?? ''; ?>"
        required
        >
        <label for="apellido" class="formulario__label">Apellido</label>
        <input
        type="text"
        class="formulario__input"
        id="apellido"
        name="apellido"
        placeholder="Ej: Pérez"
        value="<?php echo $usuario->apellido ?? ''; ?>"
        required
        >
        <label for="email" class="formulario__label">Correo</label>
        <input
        type="email"
        class="formulario__input"
        id="email"
        name="email"
        placeholder="Ej: Pérez"
        value="<?php echo $usuario->email ?? ''; ?>"
        required
        >
    </div>
</fieldset>
        <input class="formulario__submit formulario__submit--registrar" type="submit" onclick="return actualizar()" value="Actualizar usuario">
    </form>
</div>