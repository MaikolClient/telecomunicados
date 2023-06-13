<?php

namespace Model;

class Llamada extends ActiveRecord {

    protected static $tabla = 'llamada';
    protected static $columnasDB = ['id', 'emisor', 'receptor', 'duracion', 'desconexion', 'fecha' ];

    public $id;
    public $emisor;
    public $receptor;
    public $duracion;
    public $desconexion;
    public $fecha;

}