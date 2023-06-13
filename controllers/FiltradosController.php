<?php

namespace Controllers;
use Model\Anexo;
use Model\Area;
use Model\Estado;
use Model\Usuario;
use MVC\Router;


class FiltradosController {

public static function index(Router $router)
    {
        //Funcion que revisa que el usuario este autenticado
        usuario_autenticado();

        $area_sel = $_POST['area_sel'];
        $anexos = Anexo::disponiblesArea($area_sel);

        $areas = Area::all();

        foreach ($anexos as $anexo) {
            $anexo->estado_anexo = Estado::find($anexo->estado_anexo_id);
            $anexo->area = Area::find($anexo->area_id);
            $anexo->usuario = Usuario::find($anexo->creado);
        }

        //Vistas según el cargo del usuario
        if ($_SESSION['cargo_id'] == 1 || $_SESSION['cargo_id'] == 2) {
            $router->render('admin/filtrados/index', [
                'titulo' => 'Mantenedor de Anexos',
                'areas' => $areas,
                'anexos' => $anexos
            ]);
        } else {
            $router->render('supervisor/filtrados/index', [
                'titulo' => 'Mantenedor de Anexos',
                'areas' => $areas,
                'anexos' => $anexos
            ]);
        }
    }
}