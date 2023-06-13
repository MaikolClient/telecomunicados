<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton--excel" href="/admin/anexos/reporte">
        <i class="fa-solid fa-file-excel"></i>
        Reporte excel
    </a>
    <a class="dashboard__boton" href="/admin/anexos/crear">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir anexo
    </a>
</div>

<!-- Select para asignar valor de area_id -->
<form method="POST" action="/admin/filtrados">
        <label for="area_sel">Filtrar por área</label>
        <select  name="area_sel" id="area_sel">
            <option value="" >Todas las áreas</option>
            <?php foreach ($areas as $area) { ?>
                <option value="<?php echo $area->id; ?>"><?php echo $area->nombre_area; ?></option>
            <?php } ?>
        </select>

    <button class="dashboard__filtro" type="submit" name="enviar">
        <i class="fa-solid fa-search"></i>
        Buscar
    </button>
</form>

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
                <?php if(isset($_POST['enviar'])){
                    $area_sel = $_POST['area_sel'];
                } ?>

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
                            <a class="table__accion table__accion--editar" href="/admin/anexos/editar?id=<?php echo $anexo->id; ?>">
                                <i class="fa-solid fa-pen-to-square"></i>
                                Editar
                            </a>
                            <a class="table__accion table__accion--bloquear" href="/admin/anexos/bloquear?id=<?php echo $anexo->id; ?>">
                                <i class="fa-solid fa-lock"></i>
                                Bloquear
                            </a>
                            <form method="POST" action="/admin/anexos/eliminar" class="table__formulario">
                                <input type="hidden" name="id" value="<?php echo $anexo->id; ?>">
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
        <p class="text-center">No hay anexos registrados</p>
    <?php } ?>

</div>

<?php echo $paginacion; ?>