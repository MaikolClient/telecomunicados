<?php

namespace Controllers;

use Classes\Paginacion;
use Model\Logs;
use MVC\Router;


class LogsController

{
    public static function index(Router $router)
    {
        //Funcion que revisa que el usuario este autenticado
        usuario_autenticado();

        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
        
        if($_SESSION['cargo_id'] == 1 || $_SESSION['cargo_id'] == 2){
            if (!$pagina_actual || $pagina_actual < 1) {
                header('Location: /admin/logs?page=1');
            }
        } else {
            if (!$pagina_actual || $pagina_actual < 1) {
                header('Location: /supervisor/logs?page=1');
            }
        }
        

        $registros_por_pagina = 10;
        $total_registros = Logs::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total_registros);

        if($_SESSION['cargo_id'] == 1 || $_SESSION['cargo_id'] == 2){
            if($paginacion->total_paginas() < $pagina_actual){
                header('Location: /admin/logs?page=1');
            }
        } else {
            if($paginacion->total_paginas() < $pagina_actual){
                header('Location: /supervisor/logs?page=1');
            }
        }
        

        $logs = Logs::paginar2($registros_por_pagina, $paginacion->offset());

        //Vistas según el cargo del usuario
        if ($_SESSION['cargo_id'] == 1 || $_SESSION['cargo_id'] == 2) {
            $router->render('admin/logs/index', [
                'titulo' => 'Listado de logs',
                'logs' => $logs,
                'paginacion' => $paginacion->paginacion()
                
            ]);
        } else {
            $router->render('supervisor/logs/index', [
                'titulo' => 'Listado de logs',
                'logs' => $logs,
                'paginacion' => $paginacion->paginacion()
            ]);
        }
    }
}
