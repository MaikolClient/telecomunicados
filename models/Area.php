<?php

namespace Model;

class Area extends ActiveRecord {

    protected static $tabla = 'area';
    protected static $columnasDB = ['id', 'nombre_area'];

    public $id;
    public $nombre_area;
   
}