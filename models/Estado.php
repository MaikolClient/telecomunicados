<?php

namespace Model;

class Estado extends ActiveRecord {

    protected static $tabla = 'estado_anexo';
    protected static $columnasDB = ['id', 'estado'];

    public $id;
    public $estado;
   
}