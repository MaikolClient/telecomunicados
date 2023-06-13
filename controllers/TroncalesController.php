<?php

namespace Controllers;

use Model\Compania;
use Model\Troncal;
use MVC\Router;

class TroncalesController

{
    public static function index(Router $router)
    {
        //Funcion que revisa que el usuario este autenticado
        usuario_autenticado();

        $troncales = Troncal::disponibles2();

        $companias = Compania::all();

        foreach ($troncales as $troncal) {
            $troncal->compania = Compania::find($troncal->compania_id);

        }

        //Vistas según el cargo del usuario
        if ($_SESSION['cargo_id'] == 1 || $_SESSION['cargo_id'] == 2) {
            $router->render('admin/troncales/index', [
                'titulo' => 'Listado de troncales',
                'troncales' => $troncales,
                'companias' => $companias,

                
            ]);
        } else {
            $router->render('supervisor/troncales/index', [
                'titulo' => 'Listado de troncales',
                'troncales' => $troncales,
                'companias' => $companias
            ]);
        }
    }

    public static function crear(Router $router)
    {
        //Funcion que revisa que el usuario este autenticado
        session_start();
        usuario_autenticado();

        $alertas = [];

        $companias = Compania::all();

        $troncal = new Troncal();

        //Comprobar si ya existe un anexo creado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $troncal->sincronizar($_POST);

            $alertas = $troncal->validar();

            if (empty($alertas)) {
                $existeTroncal = Troncal::where2('troncal', $troncal->troncal);

                if ($existeTroncal) {
                    Troncal::setAlerta('error', 'El troncal ya está registrado');
                    $alertas = Troncal::getAlertas();
                } else {
                    // Crear un nuevo troncal
                    $resultado =  $troncal->guardar();
                    if ($resultado) {
                        time_sleep_until(time() + 3);
                        if ($_SESSION['cargo_id'] == 1 || $_SESSION['cargo_id'] == 2) {
                            header('Location: /admin/troncales');
                        } else {
                            header('Location: /supervisor/troncales');
                        }
                    }
                }
            }
        }

        if ($_SESSION['cargo_id'] == 1 || $_SESSION['cargo_id'] == 2) {
            $router->render('admin/troncales/crear', [
                'titulo' => 'Crear Troncal',
                'troncales' => $troncal,
                'companias' => $companias,
                'alertas' => $alertas
            ]);
        } else {
            $router->render('supervisor/troncales/crear', [
                'titulo' => 'Crear Troncal',
                'troncales' => $troncal,
                'companias' => $companias,
                'alertas' => $alertas
            ]);
        }
    }

    public static function editar(Router $router)
    {
        //Funcion que revisa que el usuario este autenticado
        usuario_autenticado();

        $alertas = [];

        $companias = Compania::all();

        //Validar el ID
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            if ($_SESSION['cargo_id'] == 1 || $_SESSION['cargo_id'] == 2) {
                header('Location: /admin/troncales');
            } else {
                header('Location: /supervisor/troncales');
            }
        }

        //Obtener el usuario a editar
        $troncal = Troncal::find($id);


        if (!$troncal) {
            if ($_SESSION['cargo_id'] == 1 || $_SESSION['cargo_id'] == 2) {
                header('Location: /admin/troncales');
            } else {
                header('Location: /supervisor/troncales');
            }
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $troncal->sincronizar($_POST);
            $alertas = $troncal->validar();

            if (empty($alertas)) {
                $resultado = $troncal->guardar();
                if ($resultado) {
                    time_sleep_until(time() + 3);
                    if ($_SESSION['cargo_id'] == 1 || $_SESSION['cargo_id'] == 2) {
                        header('Location: /admin/troncales');
                    } else {
                        header('Location: /supervisor/troncales');
                    }
                }
            }
        }

        //Validar el formulario

        if ($_SESSION['cargo_id'] == 1 || $_SESSION['cargo_id'] == 2) {
            $router->render('admin/troncales/editar', [
                'titulo' => 'Editar anexo',
                'alertas' => $alertas,
                'troncal' => $troncal,
                'companias' => $companias
            ]);
        } else {
            $router->render('supervisor/troncales/editar', [
                'titulo' => 'Editar anexo',
                'alertas' => $alertas,
                'troncal' => $troncal,
                'companias' => $companias
            ]);
        }
    }

    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $troncal = Troncal::find($id);

            if (!isset($troncal)) {
                header('Location: /admin/troncales');
            }

            $resultado = $troncal->eliminar2();

            if ($resultado) {
                time_sleep_until(time() + 2);
                header('Location: /admin/troncales');
            }
        }
    }

}