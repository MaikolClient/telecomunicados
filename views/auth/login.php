<main class="auth">
    <h2 class="auth__heading">
        <?php echo $titulo; ?>
    </h2>
    <p class="auth__texto">Iniciar sesión</p>

    <?php 
        require_once __DIR__ . '/../templates/alertas.php';
    ?>

    <form method="POST" action="/login" class="formulario" >
        <div class="formulario__campo">
            <label for="email" class="formulario__label">Correo Electrónico</label>
            <input 
            type="email"
            class="formulario__input"
            placeholder="Ingresa tu correo electrónico"
            id="email"
            name="email"
            value="">
        </div>
        <div class="formulario__campo">
            <label for="password" class="formulario__label">Contraseña</label>
            <input 
            type="password"
            class="formulario__input"
            placeholder="Ingresa tu contraseña"
            id="password"
            name="password">
        </div>
        <input type="submit" class="formulario__submit" value="Iniciar sesión">
    </form>

    <div class="acciones">
        <a href="/registro" class="acciones__enlace">¿Aún no tienes una cuenta? Registrate aquí</a>
        <a href="/olvide" class="acciones__enlace">¿Olvidaste tu contraseña? Ingresa aquí</a>
    </div>
</main>