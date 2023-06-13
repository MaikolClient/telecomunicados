<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<div class="dashboard__contenedor">
    <?php if (!empty($usuarios)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">ID</th>
                    <th scope="col" class="table__th">Nombre</th>
                    <th scope="col" class="table__th">Correo</th>
                    <th scope="col" class="table__th">Cargo</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>

            <tbody class="table__tbody">
                <?php foreach ($usuarios as $usuario) { ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $usuario->id; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $usuario->nombre . " " . $usuario->apellido; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $usuario->email; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $usuario->cargo->nombre_cargo; ?>
                        </td>
                        <?php if ($usuario->cargo_id == 2) { ?>
                            <td class="table__td--acciones">
                                <a class="table__accion table__accion--bloquear" >
                                    <i class="fa-solid fa-user-pen"></i>
                                    Editar
                                </a>
                            </td>
                        <?php } ?>
                        <?php if ($usuario->cargo_id == 3) { ?>
                            <td class="table__td--acciones">
                                <a class="table__accion table__accion--editar" href="/supervisor/usuarios/editar?id=<?php echo $usuario->id; ?>">
                                    <i class="fa-solid fa-user-pen"></i>
                                    Editar
                                </a>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center">No hay usuarios registrados</p>
    <?php } ?>

</div>