<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<div class="dashboard__contenedor-boton">
    <a href="/supervisor/anexos" class="dashboard__boton">
        <i class="fa-solid fa-arrow-left"></i>
        Volver
    </a>
</div>

<div class="dashboard__contenedor">

    <?php if (!empty($anexos)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">ID</th>
                    <th scope="col" class="table__th">Anexo</th>
                    <th scope="col" class="table__th">Área</th>
                    <th scope="col" class="table__th">Estado</th>
                    <th scope="col" class="table__th">Creado por</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach ($anexos as $anexo) { ?>  
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $anexo->id; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $anexo->anexo; ?>
                        <td class="table__td">
                            <?php echo $anexo->area->nombre_area; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $anexo->estado_anexo->estado; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $anexo->usuario->nombre . ' ' . $anexo->usuario->apellido; ?>
                        </td>
                        <td class="table__td--acciones">
                            <a class="table__accion table__accion--editar" href="/supervisor/anexos/editar?id=<?php echo $anexo->id; ?>">
                                <i class="fa-solid fa-pen-to-square"></i>
                                Editar
                            </a>
                            <a class="table__accion table__accion--bloquear" href="/supervisor/anexos/bloquear?id=<?php echo $anexo->id; ?>">
                                <i class="fa-solid fa-lock"></i>
                                Bloquear
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center">No hay anexos registrados</p>
    <?php } ?>

</div>
