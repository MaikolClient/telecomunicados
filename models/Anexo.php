<?php

namespace Model;

class Anexo extends ActiveRecord
{

    protected static $tabla = 'anexo';
    protected static $columnasDB = ['id', 'anexo', 'fecha', 'mensaje', 'area_id', 'estado_anexo_id', 'eliminado_id', 'creado', 'bloqueado'];

    public $id;
    public $anexo;
    public $fecha;
    public $mensaje;
    public $area_id;
    public $estado_anexo_id;
    public $eliminado_id;
    public $creado;
    public $bloqueado;


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->anexo = $args['anexo'] ?? '';
        $this->fecha = $args['fecha'] ?? date('Y-m-d H:i:s');
        $this->mensaje = $args['mensaje'] ?? '';
        $this->area_id = $args['area_id'] ?? '';
        $this->estado_anexo_id = $args['estado_anexo_id'] ?? 1;
        $this->eliminado_id = $args['eliminado_id'] ?? 1;
        $this->creado = $args['creado'] ?? $_SESSION['id'];
        $this->bloqueado = $args['bloqueado'] ?? $_SESSION['id'];
    }
}
