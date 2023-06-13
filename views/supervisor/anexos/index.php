<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>
<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/supervisor/anexos/crear">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir anexo
    </a>
</div>

<!-- Select para asignar valor de area_id -->
<form method="POST" action="/supervisor/filtrados">
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
    <?php if(!empty($anexos)) { ?>
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
                <?php foreach($anexos as $anexo) { ?>
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
                            <?php echo $anexo->estado_anexo-> estado; ?>
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

<?php echo $paginacion; ?>