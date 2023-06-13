<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<div class="dashboard__contenedor-boton">
    <a href="/admin/dashboard" class="dashboard__boton">
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
        <label for="usuario" class="formulario__label">Nombre del usuario</label>
        <input
            class="formulario__input"
            placeholder=""
            name="email"
            value="<?php echo $_SESSION['nombre'] . ' ' . $_SESSION['apellido'] ;?>"
            disabled
            >
            
        <label for="usuario" class="formulario__label">Correo electrónico</label>
        <input
        class="formulario__input"
        placeholder=""
        name="email"
        value="<?php echo $_SESSION['email'];?>"
        disabled
        >
        <label for="usuario" class="formulario__label">Cargo</label>
        <input
        class="formulario__input"
        placeholder=""
        name="cargo_id"
        value="<?php 
                if ($_SESSION['cargo_id'] == 2) {
                    echo 'Administrador';
                } if ($_SESSION['cargo_id'] == 3) {
                    echo 'Supervisor';
                } else {
                    echo 'Master';
                }
        ?>"
        disabled
        >
    </div>
</fieldset>
</div>