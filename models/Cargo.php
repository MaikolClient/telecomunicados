<?php

namespace Model;

class Cargo extends ActiveRecord {

    protected static $tabla = 'cargo';
    protected static $columnasDB = ['id', 'nombre_cargo'];

    public $id;
    public $nombre_cargo;
   
}