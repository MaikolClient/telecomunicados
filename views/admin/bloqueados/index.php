<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>
<div class="dashboard__contenedor">
    <?php if(!empty($anexos)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">ID</th>
                    <th scope="col" class="table__th">Anexo</th>
                    <th scope="col" class="table__th">Área</th>
                    <th scope="col" class="table__th">Mensaje</th>
                    <th scope="col" class="table__th">Fecha bloqueo</th>
                    <th scope="col" class="table__th">Encargado</th>
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
                        </td>
                        
                        <td class="table__td">
                            <?php echo $anexo->area->nombre_area; ?>
                        </td>
                        <td>
                            <?php echo $anexo->mensaje; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $anexo->fecha; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $anexo->usuario->nombre . ' ' . $anexo->usuario->apellido; ?>
                        </td>
                <?php } ?>
                    </tr>
            </tbody>
        </table>
        <?php } else { ?>
            <p class="text-center">No hay anexos bloqueados</p>
        <?php } ?>

</div>