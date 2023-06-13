<?php

namespace Controllers;

use Model\Anexo;
use Model\Area;
use Model\Estado;
use Model\Usuario;
use MVC\Router;

class BloqueadosController
{

    public static function index(Router $router)
    {
        //Funcion que revisa que el usuario este autenticado
        usuario_autenticado();

        $anexos = Anexo::bloqueados();

        foreach ($anexos as $anexo) {
            $anexo->estado_anexo = Estado::find($anexo->estado_anexo_id);
            $anexo->area = Area::find($anexo->area_id);
            $anexo->usuario = Usuario::find($anexo->bloqueado);
        }

        if ($_SESSION['cargo_id'] == 1 || $_SESSION['cargo_id'] == 2) {
            $router->render('admin/bloqueados/index', [
                'titulo' => 'Listado de anexos bloqueados',
                'anexos' => $anexos
            ]);
        }
        else {
            $router->render('supervisor/bloqueados/index', [
                'titulo' => 'Listado de anexos bloqueados',
                'anexos' => $anexos
            ]);
        }

    }
}
