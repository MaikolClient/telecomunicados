<main class="auth">
    <h2 class="auth__heading">
        <?php echo $titulo; ?>
    </h2>
    <p class="auth__texto">Recuperar tu acceso</p>

    <?php 
        require_once __DIR__ . '/../templates/alertas.php';
    ?>

    <form method="POST" action="/olvide" class="formulario">
        <div class="formulario__campo">
            <label for="email" class="formulario__label">Correo Electrónico</label>
            <input type="email" class="formulario__input" placeholder="Ingresa tu correo electrónico" id="email" name="email">
        </div>
        <input type="submit" class="formulario__submit" value="Enviar instrucciones">
    </form>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes una cuenta? Ingresa aquí</a>
        <a href="/registro" class="acciones__enlace">¿Aún no tienes una cuenta? Registrate aquí</a>
    </div>
</main>