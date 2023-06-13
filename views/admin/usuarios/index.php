<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/usuarios/crear">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir usuario
    </a>
</div>

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
                            <?php echo $usuario->id ?>
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

                        <td class="table__td--acciones">    
                            <?php if ($usuario->cargo_id == 2 || $usuario->cargo_id == 3) { ?>
                                <a class="table__accion table__accion--editar" href="/admin/usuarios/editar?id=<?php echo $usuario->id; ?>">
                                    <i class="fa-solid fa-user-pen"></i>
                                    Editar
                                </a>
                            <?php } ?>
                            <?php if ($usuario->cargo_id == 2) { ?>
                                <form method="POST" action="/admin/usuarios/eliminar" class="table__formulario">
                                    <input type="hidden" name="id" value="<?php echo $usuario->id; ?>">
                                    <button class="table__accion table__accion--bloquear" disabled>
                                        <i class="fa-solid fa-circle-xmark"></i>
                                        Eliminar
                                    </button>
                                </form>
                            <?php } ?>
                            <?php if ($usuario->cargo_id == 3) { ?>
                                <form method="POST" action="/admin/usuarios/eliminar" class="table__formulario">
                                    <input type="hidden" name="id" value="<?php echo $usuario->id; ?>">
                                    <button class="table__accion table__accion--eliminar" type="submit" onclick="return eliminar()">
                                        <i class="fa-solid fa-circle-xmark"></i>
                                        Eliminar
                                    </button>
                                </form>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center">No hay usuarios registrados</p>
    <?php } ?>

</div>