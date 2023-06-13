<?php

namespace Model;

class Logs extends ActiveRecord {

    protected static $tabla = 'log';
    protected static $columnasDB = ['id', 'mensaje', 'fecha'];

    public $id;
    public $mensaje;
    public $fecha;
   
}