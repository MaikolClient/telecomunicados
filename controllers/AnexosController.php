<?php

namespace Controllers;

use Classes\Notificacion;
use Classes\Paginacion;
use Model\Anexo;
use Model\Area;
use Model\Estado;
use Model\Usuario;
use MVC\Router;

class AnexosController
{

    public static function index(Router $router)
    {
        //Funcion que revisa que el usuario este autenticado
        usuario_autenticado();

        $anexos = Anexo::anexos_disponibles();

        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
        
        if($_SESSION['cargo_id'] == 1 || $_SESSION['cargo_id'] == 2 || $_SESSION['cargo_id'] == 2){
            if (!$pagina_actual || $pagina_actual < 1) {
                header('Location: /admin/anexos?page=1');
            }
        } else {
            if (!$pagina_actual || $pagina_actual < 1) {
                header('Location: /supervisor/anexos?page=1');
            }
        }

        $registros_por_pagina = 10;
        $total_registros = Anexo::total2();
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total_registros);

        if($_SESSION['cargo_id'] == 1 || $_SESSION['cargo_id'] == 2 || $_SESSION['cargo_id'] == 2){
            if($paginacion->total_paginas() < $pagina_actual){
                header('Location: /admin/anexos?page=1');
            }
        } else {
            if($paginacion->total_paginas() < $pagina_actual){
                header('Location: /supervisor/anexos?page=1');
            }
        }

        $anexos = Anexo::paginar($registros_por_pagina, $paginacion->offset());

        $areas = Area::all();

        foreach ($anexos as $anexo) {
            $anexo->estado_anexo = Estado::find($anexo->estado_anexo_id);
            $anexo->area = Area::find($anexo->area_id);
            $anexo->usuario = Usuario::find($anexo->creado);
        }

        //Vistas según el cargo del usuario
        if ($_SESSION['cargo_id'] == 1 || $_SESSION['cargo_id'] == 2 || $_SESSION['cargo_id'] == 2) {
            $router->render('admin/anexos/index', [
                'titulo' => 'Mantenedor de Anexos',
                'areas' => $areas,
                'anexos' => $anexos,
                'paginacion' => $paginacion->paginacion(),
            ]);
        } else {
            $router->render('supervisor/anexos/index', [
                'titulo' => 'Mantenedor de Anexos',
                'areas' => $areas,
                'anexos' => $anexos,
                'paginacion' => $paginacion->paginacion(),
            ]);
        }
    }

    public static function crear(Router $router)
    {
        //Funcion que revisa que el usuario este autenticado
        session_start();
        usuario_autenticado();

        $alertas = [];

        $areas = Area::all();

        $anexo = new Anexo();

        //Comprobar si ya existe un anexo creado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $anexo->sincronizar($_POST);

            $alertas = $anexo->validar();

            if (empty($alertas)) {
                $existeAnexo = Anexo::where('anexo', $anexo->anexo);

                if ($existeAnexo) {
                    Anexo::setAlerta('error', 'El anexo ya está registrado');
                    $alertas = Anexo::getAlertas();
                } else {
                    // Crear un nuevo anexo
                    $resultado =  $anexo->guardar();
                    if ($resultado) {
                        time_sleep_until(time() + 2);
                        if ($_SESSION['cargo_id'] == 1 || $_SESSION['cargo_id'] == 2 || $_SESSION['cargo_id'] == 2) {
                            header('Location: /admin/anexos');
                        } else {

                            header('Location: /supervisor/anexos');
                        }
                    }
                }
            }
        }

        if ($_SESSION['cargo_id'] == 1 || $_SESSION['cargo_id'] == 2) {
            $router->render('admin/anexos/crear', [
                'titulo' => 'Crear Anexo',
                'anexo' => $anexo,
                'areas' => $areas,
                'alertas' => $alertas
            ]);
        } else {
            $router->render('supervisor/anexos/crear', [
                'titulo' => 'Crear Anexo',
                'anexo' => $anexo,
                'alertas' => $alertas,
                'areas' => $areas
            ]);
        }
    }

    public static function editar(Router $router)
    {
        //Funcion que revisa que el usuario este autenticado
        usuario_autenticado();

        $alertas = [];

        $areas = Area::all();

        //Validar el ID
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            if ($_SESSION['cargo_id'] == 1 || $_SESSION['cargo_id'] == 2) {
                header('Location: /admin/anexos');
            } else {
                header('Location: /supervisor/anexos');
            }
        }

        //Obtener el usuario a editar
        $anexo = Anexo::find($id);


        if (!$anexo) {
            if ($_SESSION['cargo_id'] == 1 || $_SESSION['cargo_id'] == 2) {
                header('Location: /admin/anexos');
            } else {
                header('Location: /supervisor/anexos');
            }
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $anexo->sincronizar($_POST);
            $alertas = $anexo->validar();

            if (empty($alertas)) {
                $resultado = $anexo->guardar();
                if ($resultado) {
                    time_sleep_until(time() + 3);
                    if ($_SESSION['cargo_id'] == 1 || $_SESSION['cargo_id'] == 2) {
                        header('Location: /admin/anexos');
                    } else {
                        header('Location: /supervisor/anexos');
                    }
                }
            }
        }

        //Validar el formulario

        if ($_SESSION['cargo_id'] == 1 || $_SESSION['cargo_id'] == 2) {
            $router->render('admin/anexos/editar', [
                'titulo' => 'Editar anexo',
                'alertas' => $alertas,
                'anexo' => $anexo,
                'areas' => $areas
            ]);
        } else {
            $router->render('supervisor/anexos/editar', [
                'titulo' => 'Editar anexo',
                'alertas' => $alertas,
                'anexo' => $anexo,
                'areas' => $areas
            ]);
        }
    }
    public static function bloquear(Router $router)
    {
        //Funcion que revisa que el usuario este autenticado
        usuario_autenticado();

        $alertas = [];

        $anexo = Anexo::all();
        $areas = Area::all();
        $estados = Estado::all();

        //Validar el ID
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            if ($_SESSION['cargo_id'] == 1 || $_SESSION['cargo_id'] == 2) {
                header('Location: /admin/anexos');
            } else {
                header('Location: /supervisor/anexos');
            }
        }

        //Obtener el usuario a editar
        $anexo = Anexo::find($id);


        if (!$anexo) {
            if ($_SESSION['cargo_id'] == 1 || $_SESSION['cargo_id'] == 2) {
                header('Location: /admin/anexos');
            } else {
                header('Location: /supervisor/anexos');
            }
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $anexo->sincronizar($_POST);
            $alertas = $anexo->validar();

            if (empty($alertas)) {
                $resultado = $anexo->guardar();
                if ($resultado) {
                    time_sleep_until(time() + 3);
                    if ($_SESSION['cargo_id'] == 1 || $_SESSION['cargo_id'] == 2) {
                        header('Location: /admin/anexos');
                    } else {
                        header('Location: /supervisor/anexos');
                    }
                }
            }
        }

        //Validar el formulario

        if ($_SESSION['cargo_id'] == 1 || $_SESSION['cargo_id'] == 2) {
            $router->render('admin/anexos/bloquear', [
                'titulo' => 'Bloquear anexo',
                'alertas' => $alertas,
                'anexo' => $anexo,
                'areas' => $areas,
                'estados' => $estados
            ]);
        } else {
            $router->render('supervisor/anexos/bloquear', [
                'titulo' => 'Bloquear anexo',
                'alertas' => $alertas,
                'anexo' => $anexo,
                'areas' => $areas,
                'estados' => $estados
            ]);
        }
    }
    public static function eliminar()
    {
        //Funcion que revisa que el usuario este autenticado
        usuario_autenticado();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $anexo = Anexo::find($id);


            if (!isset($anexo)) {
                header('Location: /admin/anexos');
            }

            $resultado = $anexo->eliminar2();
            

            $usuario = $_SESSION['nombre'] . " " . $_SESSION['apellido'];

            //Enviar correo de eliminacion
            $email = new Notificacion($usuario, $anexo->anexo);
            $email->enviarNotificacion();

            if ($resultado) {
                header('Location: /admin/anexos');
            }
        }
    }

    public static function reporte(Router $router)
    {
        //Funcion que revisa que el usuario este autenticado
        usuario_autenticado();

        $router->render('admin/anexos/reporte', [
            'titulo' => 'Mantenedor de Anexos'

        ]);
    }
}
