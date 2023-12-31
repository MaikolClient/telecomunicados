<?php

namespace Model;

use mysqli;

class ActiveRecord
{

    // Base DE DATOS
    protected static $db;
    protected static $tabla = '';
    protected static $columnasDB = [];

    // Alertas y Mensajes
    protected static $alertas = [];

    // Definir la conexión a la BD - includes/database.php
    public static function setDB($database)
    {
        self::$db = $database;
    }

    // Setear un tipo de Alerta
    public static function setAlerta($tipo, $mensaje)
    {
        static::$alertas[$tipo][] = $mensaje;
    }

    // Obtener las alertas
    public static function getAlertas()
    {
        return static::$alertas;
    }

    // Validación que se hereda en modelos
    public function validar()
    {
        static::$alertas = [];
        return static::$alertas;
    }

    // Consulta SQL para crear un objeto en Memoria (Active Record)
    public static function consultarSQL($query)
    {
        // Consultar la base de datos
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        // liberar la memoria
        $resultado->free();

        // retornar los resultados
        return $array;
    }


    // Crea el objeto en memoria que es igual al de la BD
    protected static function crearObjeto($registro)
    {
        $objeto = new static;

        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    // Identificar y unir los atributos de la BD
    public function atributos()
    {
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
            if ($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    // Sanitizar los datos antes de guardarlos en la BD
    public function sanitizarAtributos()
    {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    // Sincroniza BD con Objetos en memoria
    public function sincronizar($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

    // Registros - CRUD
    public function guardar()
    {
        $resultado = '';
        if (!is_null($this->id)) {
            // actualizar
            $resultado = $this->actualizar();
        } else {
            // Creando un nuevo registro
            $resultado = $this->crear();
        }
        return $resultado;
    }

    // Obtener todos los Registros
    public static function all()
    {
        $query = "SELECT * FROM " . static::$tabla . " ORDER BY id ASC";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    // Obtener todos los Registros
    public static function all2()
    {
        $query = "SELECT * FROM " . static::$tabla . " ORDER BY id DESC";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    public static function all3(){
        $query = "SELECT * FROM telecomunicados.usuario ORDER BY id ASC";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    
    public static function activos()
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE eliminado_id = 1 ORDER BY cargo_id ASC";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public static function disponibles2()
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE eliminado_id = 1";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //Obtener los anexos que no esten bloqueados, estado_anexo_id = 1
    public static function anexos_disponibles()
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE estado_anexo_id = 1 AND eliminado_id = 1 ORDER BY id desc";
        $resultado = self::consultarSQL($query);
        return ($resultado); 
    }
    //Obtener los anexos según su filtro de area_id
    public static function disponiblesArea($area_id)
    {
        if ($area_id < 1) {
            $query = "SELECT * FROM " . static::$tabla . " WHERE estado_anexo_id = 1 AND eliminado_id = 1 ORDER BY id desc";
            $resultado = self::consultarSQL($query);
            return $resultado;
        } else {
            $query = "SELECT * FROM " . static::$tabla . " WHERE area_id = ${area_id} AND estado_anexo_id = 1 AND eliminado_id = 1 ORDER BY id desc";
            $resultado = self::consultarSQL($query);
            return $resultado;
        }
    }
    
    //Llamar procedimiento almacenado que trae los logs
    public static function logs()
    {
        $query = "CALL sp_logs()";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //Llamar procedimiento almacenado que trae los anexos bloqueados
    public static function bloqueados()
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE estado_anexo_id = 2 AND eliminado_id = 1 ORDER BY fecha desc";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // Busca un registro por su id
    public static function find($id)
    {
        $query = "SELECT * FROM " . static::$tabla  . " WHERE id = ${id}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    // Obtener Registros con cierta cantidad
    public static function get($limite)
    {
        $query = "SELECT * FROM " . static::$tabla . " ORDER BY id DESC LIMIT ${limite} " ;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    public static function get2($limite)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE eliminado_id = 1 ORDER BY id DESC  LIMIT ${limite} " ;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }



    //Paginar los registros
    public static function paginar($por_pagina, $offset)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE eliminado_id = 1 AND estado_anexo_id = 1 ORDER BY id DESC LIMIT ${por_pagina} OFFSET ${offset}  ";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    public static function paginar2($por_pagina, $offset)
    {
        $query = "SELECT * FROM " . static::$tabla . " ORDER BY id DESC LIMIT ${por_pagina} OFFSET ${offset}  ";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    // Busqueda Where con Columna 
    public static function where($columna, $valor)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE ${columna} = '${valor}'";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }
    // Busqueda Where con Columna 
    public static function where2($columna, $valor)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE ${columna} = ' ${valor}'";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    //Traer un total de registros
    public static function total()
    {
        $query = "SELECT COUNT(*) FROM " . static::$tabla;
        $resultado = self::$db->query($query);
        $total_registros = $resultado->fetch_array();
        
        return array_shift($total_registros);
    }
    //Traer un total de registros
    public static function total2()
    {
        $query = "SELECT COUNT(*) FROM " . static::$tabla . " WHERE eliminado_id = 1 AND estado_anexo_id = 1 "; 
        $resultado = self::$db->query($query);
        $total_registros = $resultado->fetch_array();
        
        return array_shift($total_registros);
    }

    public static function totalArray($array = []){
        $query = "SELECT COUNT(*) FROM " . static::$tabla . " WHERE ";
        foreach ($array as $key => $value) {
            if($key == array_key_last($array)){
                $query .= " ${key} = '${value}' ";
            } else{
                $query .= " ${key} = '${value}' AND ";
            }
        }
        $resultado = self::$db->query($query);
        $total = $resultado->fetch_array();
        return array_shift($total);
    }


    // crea un nuevo registro
    public function crear()
    {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Insertar en la base de datos
        $query = "INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        // debuguear($query); // Descomentar si no te funciona algo

        // Resultado de la consulta
        $resultado = self::$db->query($query);
        return [
            'resultado' =>  $resultado,
            'id' => self::$db->insert_id
        ];
    }

    // Actualizar el registro
    public function actualizar()
    {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Iterar para ir agregando cada campo de la BD
        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        // Consulta SQL
        $query = "UPDATE " . static::$tabla . " SET ";
        $query .=  join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";

        // Actualizar BD
        $resultado = self::$db->query($query);
        return $resultado;
    }



    // Elimina usuarios
    public function eliminar()
    {
        $query = "CALL sp_eliminar_usuario( '" . self::$db->escape_string($this->id) . "', '" . static::$tabla . "' )";
        $resultado = self::$db->query($query);
        return $resultado;
    }

    //Elimina datos en general
    public function eliminar2()
    {
        $query = "CALL sp_eliminar( '" . self::$db->escape_string($this->id) . "', '" . static::$tabla . "' )";
        $resultado = self::$db->query($query);
        return $resultado;
    }

    //Insertar log de inicio de sesión en la base de datos
    public static function insertarLog($usuario)
    {
         $query = "CALL sp_ins_log( '" . self::$db->escape_string($usuario) . "')";
         $resultado = self::$db->query($query);
         return $resultado;
    }

}