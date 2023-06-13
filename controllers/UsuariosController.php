<?php

namespace Controllers;

use Classes\Email;
use Model\Cargo;
use Model\Usuario;
use MVC\Router;

class UsuariosController
{

    public static function index(Router $router)
    {

        //Funcion que revisa que el usuario este autenticado
        usuario_autenticado();

        $usuarios = Usuario::activos();

        foreach ($usuarios as $usuario) {
            $usuario->cargo = Cargo::find($usuario->cargo_id);
        }
        
        if ($_SESSION['cargo_id'] == 1 || $_SESSION['cargo_id'] == 2) {
            $router->render('admin/usuarios/index', [
                'titulo' => 'Listado de usuarios',
                'usuarios' => $usuarios
            ]);
        } else {
            $router->render('supervisor/usuarios/index', [
                'titulo' => 'Listado de usuarios',
                'usuarios' => $usuarios
            ]);
        }
    }
    public static function crear(Router $router)
    {
        //Funcion que revisa que el usuario este autenticado
        session_start();
        usuario_autenticado();

        $alertas = [];

        $cargos = Cargo::all();

        $usuario = new Usuario();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $usuario->sincronizar($_POST);

            $alertas = $usuario->validar();

            if (empty($alertas)) {
                $existeUsuario = Usuario::where('email', $usuario->email);

                if ($existeUsuario) {
                    Usuario::setAlerta('error', 'El Usuario ya está registrado');
                    $alertas = Usuario::getAlertas();
                } else {
                    // Hashear el password
                    $usuario->hashPassword();

                    // Generar el Token
                    $usuario->crearToken();

                    // Crear un nuevo usuario
                    $resultado =  $usuario->guardar();

                    // Enviar email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();

                    if ($resultado) {
                        time_sleep_until(time()+3);
                        header('Location: /admin/usuarios');
                    }

                }
            }
        }

        $router->render('admin/usuarios/crear', [
            'titulo' => 'Crear Usuario',
            'alertas' => $alertas,
            'usuario' => $usuario,
            'cargos' => $cargos
        ]);
    }


    public static function editar(Router $router)
    {
        //Funcion que revisa que el usuario este autenticado
        usuario_autenticado();

        $alertas = [];

        $cargos = Cargo::all();

        //Validar el ID
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            header('Location: /admin/usuarios');
        }

        //Obtener el usuario a editar
        $usuario = Usuario::find($id);


        if (!$usuario) {
            header('Location: /admin/usuarios');
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validar();

            if (empty($alertas)) {
                $resultado = $usuario->guardar();
                if ($resultado) {
                    if ($_SESSION['cargo_id'] == 1 || $_SESSION['cargo_id'] == 2) {
                        time_sleep_until(time()+3);
                        header('Location: /admin/usuarios');
                    } else {
                        time_sleep_until(time()+3);
                        header('Location: /supervisor/usuarios');
                    }
                }
            }
        }

        //Validar el formulario
        if ($_SESSION['cargo_id'] == 1 || $_SESSION['cargo_id'] == 2) {
            $router->render('admin/usuarios/editar', [
                'titulo' => 'Actualizar Usuario',
                'alertas' => $alertas,
                'usuario' => $usuario,
                'cargos' => $cargos
            ]);
        } else {
            $router->render('supervisor/usuarios/editar', [
                'titulo' => 'Actualizar Usuario',
                'alertas' => $alertas,
                'usuario' => $usuario,
                'cargos' => $cargos
            ]);
        }
    }


    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $usuario = Usuario::find($id);

            if (!isset($usuario)) {
                header('Location: /admin/usuarios');
            }

            $resultado = $usuario->eliminar();

            if ($resultado) {
                time_sleep_until(time()+3);
                header('Location: /admin/usuarios');
            }
        }
    }
    public static function perfil(Router $router)
    {
        $usuarios = Usuario::all3();
        $cargos = Cargo::all();


        usuario_autenticado();

        if ($_SESSION['cargo_id'] == 1 || $_SESSION['cargo_id'] == 2) {
            $router->render('admin/perfil/index', [
                'titulo' => 'Perfil de usuario',
                'usuarios' => $usuarios,
                'cargos' => $cargos
            ]);
        } else {
            $router->render('supervisor/perfil/index', [
                'titulo' => 'Perfil de usuario',
                'usuarios' => $usuarios,
                'cargos' => $cargos
            ]);
        }
    }

}
