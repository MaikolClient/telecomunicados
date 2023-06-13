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
    <form method="POST" action="/admin/troncales/crear" class="formulario">
        <?php include __DIR__ . '/formulario.php'; ?>
        <input class="formulario__submit formulario__submit--registrar" type="submit" onclick="return crear()" value="Registrar troncal">
    </form>
</div>