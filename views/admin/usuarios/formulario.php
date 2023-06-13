<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información del usuario</legend>

    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre</label>
        <input
        type="text"
        class="formulario__input"
        id="nombre"
        name="nombre"
        placeholder="Ej: Juan"
        value="<?php echo $usuario->nombre ?? ''; ?>"
        required
        >
        <label for="apellido" class="formulario__label">Apellido</label>
        <input
        type="text"
        class="formulario__input"
        id="apellido"
        name="apellido"
        placeholder="Ej: Pérez"
        value="<?php echo $usuario->apellido ?? ''; ?>"
        required
        >
        <label for="email" class="formulario__label">Correo</label>
        <input
        type="email"
        class="formulario__input"
        id="email"
        name="email"
        placeholder="Ej: correo@correo.cl"
        value="<?php echo $usuario->email ?? ''; ?>"
        required
        >
        <label for="password" class="formulario__label">Contraseña</label>
        <input
        type="password"
        class="formulario__input"
        id="password"
        name="password"
        placeholder="Ej: 123456"
        value="<?php echo $usuario->password ?? ''; ?>"
        required
        >
        
        <label for="cargo" class="formulario__label">Seleccionar Rol</label>
        <select
            class="formulario__select"
            id="cargo"
            name="cargo_id"
            required>
                <option value="2>">Administrador</option>
                <option value="3>">Supervisor</option>
        </select>
    </div>
</fieldset>