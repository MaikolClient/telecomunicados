<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<div class="dashboard__contenedor">
    <?php if(!empty($logs)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">ID</th>
                    <th scope="col" class="table__th">Mensaje</th>
                    <th scope="col" class="table__th">Fecha y Hora</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>

            <tbody class="table__tbody">
                <?php foreach($logs as $log) { ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $log->id; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $log->mensaje; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $log->fecha; ?>
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