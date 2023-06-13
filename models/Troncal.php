<?php

namespace Model;

class Troncal extends ActiveRecord {

    protected static $tabla = 'troncal';
    protected static $columnasDB = ['id', 'troncal', 'compania_id', 'eliminado_id'];

    public $id;
    public $troncal;
    public $compania_id;
    public $eliminado_id;
   

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->troncal = $args['troncal'] ?? '';
        $this->compania_id = $args['compania_id'] ?? '';
        $this->eliminado_id = $args['eliminado_id'] ?? 1;

    }
}