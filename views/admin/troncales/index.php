<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>
<div class="dashboard__contenedor-boton">
    
    <a class="dashboard__boton" href="/admin/troncales/crear">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir troncal
    </a>
</div>

<div class="dashboard__contenedor">
    <?php if(!empty($troncales)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">ID</th>
                    <th scope="col" class="table__th">Troncal</th>
                    <th scope="col" class="table__th">Compañia</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>

            <tbody class="table__tbody">
                <?php foreach($troncales as $troncal) { ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $troncal->id; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $troncal->troncal; ?>
                        <td class="table__td">
                            <?php echo $troncal->compania->nombre_compania; ?>
                        </td>
                        <td class="table__td--acciones">
                            <a class="table__accion table__accion--editar" href="/admin/troncales/editar?id=<?php echo $troncal->id; ?>">
                            <i class="fa-solid fa-pen-to-square"></i>
                                Editar
                            </a>
                            <form method="POST" action="/admin/troncales/eliminar" class="table__formulario">
                                <input type="hidden" name="id" value="<?php echo $troncal->id; ?>">
                                <button class="table__accion table__accion--eliminar" type="submit" onclick="return eliminar()">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php } else { ?>
            <p class="text-center">No hay troncales registrados</p>
        <?php } ?>
    
</div>