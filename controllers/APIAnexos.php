<?php 

namespace Controllers;

use Model\Anexo;
use Model\Area;

class APIAnexos
{
    public static function index()
    {
        $anexos = Anexo::disponibles();

        

        echo json_encode($anexos);
  
    }
}