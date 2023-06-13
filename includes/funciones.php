<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function pagina_actual ($path) {
    return str_contains( $_SERVER['PATH_INFO'], $path ) ? true : false;
}

//Funcion que revisa que el usuario este autenticado
function usuario_autenticado() {
    session_start();

    if(!isset($_SESSION['login'])) {
        header('Location: /login');
    }
}
