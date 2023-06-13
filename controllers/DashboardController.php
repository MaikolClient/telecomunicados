<?php

namespace Controllers;

use Model\Cargo;
use Model\Usuario;
use MVC\Router;

class DashboardController
{

    public static function index(Router $router)
    {

        usuario_autenticado();

        //Obtener los ultimos registros de usuarios
        $usuarios = Usuario::get2(5);

        

        if ($_SESSION['cargo_id'] == 1 || $_SESSION['cargo_id'] == 2) {
            $router->render('admin/dashboard/index', [
                'titulo' => 'Panel de Administración',
                'usuarios' => $usuarios
            ]);
        } else {
            $router->render('supervisor/dashboard/index', [
                'titulo' => 'Panel de Administración',
                'usuarios' => $usuarios
            ]);
        }
    }
    public static function logout()
    {
        //Funcion para cerrar sesion de usuario
        session_start();
    }

}
