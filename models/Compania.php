<?php

namespace Model;

class Compania extends ActiveRecord {

    protected static $tabla = 'compania';
    protected static $columnasDB = ['id', 'nombre_compania'];

    public $id;
    public $nombre_compania;
   
}