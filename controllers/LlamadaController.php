<?php

namespace Controllers;

use Classes\Paginacion;
use Model\Anexo;
use Model\Llamada;
use Model\Usuario;
use MVC\Router;


class LlamadaController

{
    public static function index(Router $router)
    {
        //Funcion que revisa que el usuario este autenticado
        usuario_autenticado();

        $llamadas = Llamada::all();

        foreach ($llamadas as $llamada) {
            //Traer el anexo del emisor de la llamada y el receptor
            $llamada->emisor = Anexo::find($llamada->emisor);
            $llamada->receptor = Anexo::find($llamada->receptor);
        }


        //Vistas según el cargo del usuario
        if ($_SESSION['cargo_id'] == 1 || $_SESSION['cargo_id'] == 2) {
            $router->render('admin/llamadas/index', [
                'titulo' => 'Registro de llamadas',
                'llamadas' => $llamadas
                
            ]);
        } else {
            $router->render('supervisor/llamadas/index', [
                'titulo' => 'Registro de llamadas',
                'llamadas' => $llamadas
            ]);
        }
    }
}
