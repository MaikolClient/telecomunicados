<?php
use Model\Anexo;
?>
<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<main class="bloques">
    <div class="bloques__grid">
        <div class="bloque">
            <h3 class="bloque__heading">Últimos usuarios</h3>

            <?php foreach ($usuarios as $usuario) : ?>
                <div class="bloque__contenido">
                    <p class="bloque__texto"><?php echo $usuario->nombre . ' ' . $usuario->apellido; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="bloque">
            <h3 class="bloque__heading">Anexos activos</h3>
            <p class="bloque__texto--cantidad">
                <?php
                $anexos = Anexo::total2();
                echo $anexos;
                ?>
            </p>
        </div>
    </div>
</main>