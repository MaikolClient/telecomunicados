//Función para cerrar sesión
function logout() {
    var respuesta = confirm("¿Estás seguro de cerrar tu sesión?");
    if (respuesta == true) {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Sesión cerrada con éxito',
            showConfirmButton: false,
            timer: 1500
        });
        return true;
    } else {
        Swal.fire({
            position: 'center',
            icon: 'info',
            title: 'No se ha cerrado la sesión',
            showConfirmButton: false,
            timer: 1500
        })
        return false;

    }
}

function eliminar() {
    var respuesta = confirm("¿Estás seguro de eliminar este registro?");
    if (respuesta == true) {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Registro eliminado con éxito',
            showConfirmButton: false,
            timer: 1500
        });
        return true;
    } else {
        Swal.fire({
            position: 'center',
            icon: 'info',
            title: 'No se ha eliminado el registro',
            showConfirmButton: false,
            timer: 1500
        })
        return false;
    }
}

function crear() {
    var respuesta = confirm("¿Estás seguro de crear este registro?");
    if (respuesta == true) {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Registro creado con éxito',
            showConfirmButton: false,
            timer: 1500
        });
        return true;
    } else {
        Swal.fire({
            position: 'center',
            icon: 'info',
            title: 'No se ha eliminado el registro',
            showConfirmButton: false,
            timer: 1500
        })
        return false;
    }
}

function actualizar() {
    var respuesta = confirm("¿Estás seguro de actualizar este registro?");
    if (respuesta == true) {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Registro actualizado',
            showConfirmButton: false,
            timer: 1500
        });
        return true;
    } else {
        Swal.fire({
            position: 'center',
            icon: 'info',
            title: 'No se ha eliminado el registro',
            showConfirmButton: false,
            timer: 1500
        })
        return false;
    }
}
function actualizar() {
    var respuesta = confirm("¿Estás seguro de actualizar el registro?");
    if (respuesta == true) {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Registro actualizado',
            showConfirmButton: false,
            timer: 1500
        });
        return true;
    } else {
        Swal.fire({
            position: 'center',
            icon: 'info',
            title: 'No se ha eliminado el registro',
            showConfirmButton: false,
            timer: 1500
        })
        return false;
    }
}

function bloquear() {
    var respuesta = confirm("¿Estás seguro de actualizar el registro?");
    if (respuesta == true) {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Registro actualizado',
            showConfirmButton: false,
            timer: 1500
        });
        return true;
    } else {
        Swal.fire({
            position: 'center',
            icon: 'info',
            title: 'No se ha eliminado el registro',
            showConfirmButton: false,
            timer: 1500
        })
        return false;
    }
}
