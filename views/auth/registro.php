<main class="auth">
    <h2 class="auth__heading">
        <?php echo $titulo; ?>
    </h2>
    <p class="auth__texto">Registrate ingresando tus datos</p>
    <?php 
        require_once __DIR__ . '/../templates/alertas.php'
    ?>


    <form method="POST" action="/registro" class="formulario">
        <div class="formulario__campo">
            <label for="nombre" class="formulario__label">Nombre</label>
            <input 
            type="text"
            class="formulario__input"
            placeholder="Ingresa tu nombre. Ej: Diego"
            id="nombre"
            name="nombre"
            value="<?php echo $usuario->nombre?>">
        </div>
        <div class="formulario__campo">
            <label for="apellido" class="formulario__label">Apellido</label>
            <input 
            type="text"
            class="formulario__input"
            placeholder="Ingresa tu apellido. Ej: Maradona"
            id="apellido"
            name="apellido"
            value="<?php echo $usuario->apellido?>">
        </div>
        <div class="formulario__campo">
            <label for="email" class="formulario__label">Correo Electrónico</label>
            <input 
            type="email"
            class="formulario__input"
            placeholder="Ingresa tu correo electrónico"
            id="email"
            name="email"
            value="<?php echo $usuario->email?>">
        </div>
        <div class="formulario__campo">
            <label for="password" class="formulario__label">Contraseña</label>
            <input 
            type="password"
            class="formulario__input"
            placeholder="Ingresa tu contraseña"
            id="password"
            name="password"
            minlength="6">
        </div>
        <div class="formulario__campo">
            <label for="password2" class="formulario__label">Repetir Contraseña</label>
            <input 
            type="password"
            class="formulario__input"
            placeholder="Repite tu contraseña"
            id="password2"
            name="password2"
            minlength="6"
            >
        </div>
        <input type="submit" class="formulario__submit" value="Crear cuenta">
    </form>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes una cuenta? Ingresa aquí</a>
        <a href="/olvide" class="acciones__enlace">¿Olvidaste tu contraseña? Ingresa aquí</a>
    </div>
</main>