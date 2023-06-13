<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<div class="dashboard__contenedor">
    <?php if(!empty($llamadas)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">ID</th>
                    <th scope="col" class="table__th">Emisor</th>
                    <th scope="col" class="table__th">Receptor</th>
                    <th scope="col" class="table__th">Duración</th>
                    <th scope="col" class="table__th">Desconexión</th>
                    <th scope="col" class="table__th">Fecha</th>
                </tr>
            </thead>

            <tbody class="table__tbody">
                <?php foreach($llamadas as $llamada) { ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $llamada->id; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $llamada->emisor->anexo; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $llamada->receptor->anexo; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $llamada->duracion; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $llamada->desconexion; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $llamada->fecha; ?>
                        </td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php } else { ?>
            <p class="text-center">No hay registros</p>
        <?php } ?>
    
</div>

<?php echo $paginacion; ?>  