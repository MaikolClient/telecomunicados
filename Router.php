<?php

namespace MVC;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function comprobarRutas()
    {

        $url_actual = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            $fn = $this->getRoutes[$url_actual] ?? null;
        } else {
            $fn = $this->postRoutes[$url_actual] ?? null;
        }

        if ( $fn ) {
            call_user_func($fn, $this);
        } else {
            header('Location: /404');
        }
    }

    public function render($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
            $$key = $value; 
        }

        ob_start(); 

        include_once __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean(); // Limpia el Buffer


        //Utilizar el lauout de acuerdo a la URL
        $url_actual = $_SERVER['PATH_INFO'] ?? '/';

        //Comprobar si la url corresponde a admin o supervisores
        if(str_contains($url_actual, '/admin')) {
            include_once __DIR__ . '/views/admin-layout.php';
        }
        else if(str_contains($url_actual, '/supervisor')) {
            include_once __DIR__ . '/views/supervisor-layout.php';
        }
        else {
            include_once __DIR__ . '/views/layout.php';
        }
    }
}
