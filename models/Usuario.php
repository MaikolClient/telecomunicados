<?php

namespace Model;

class Usuario extends ActiveRecord {

    protected static $tabla = 'usuario';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password', 'confirmado', 'token', 'cargo_id', 'eliminado_id'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $password2;
    public $confirmado;
    public $token;
    public $cargo_id;
    public $eliminado_id;
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
        $this->token = $args['token'] ?? '';
        $this->cargo_id = $args['cargo_id'] ?? 3;
        $this->eliminado_id = $args['eliminado_id'] ?? 1;

    }

    // Validar el Login de Usuarios
    public function validarLogin() {
        if(!$this->email) {
            self::$alertas['error'][] = 'El Email del Usuario es Obligatorio';
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'Email no válido';
        }
        if(!$this->password) {
            self::$alertas['error'][] = 'La contraseña no puede ir vacio';
        }
        return self::$alertas;

    }

    // Validación para cuentas nuevas
    public function validar_cuenta() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre es Obligatorio';
        }
        if(!$this->apellido) {
            self::$alertas['error'][] = 'El Apellido es Obligatorio';
        }
        if(!$this->email) {
            self::$alertas['error'][] = 'El Email es Obligatorio';
        }
        if(!$this->password) {
            self::$alertas['error'][] = 'La contraseña no puede ir vacia';
        }
        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = 'La contraseña debe contener al menos 5 caracteres';
        }
        if($this->password !== $this->password2) {
            self::$alertas['error'][] = 'Las contraseñas no son iguales';
        }
        return self::$alertas;
    }

    // Valida un email
    public function validarEmail() {
        if(!$this->email) {
            self::$alertas['error'][] = 'El Email es Obligatorio';
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'Email no válido';
        }
        return self::$alertas;
    }

    // Valida La contraseña 
    public function validarPassword() {
        if(!$this->password) {
            self::$alertas['error'][] = 'La contraseña no puede ir vacio';
        }
        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = 'La contraseña debe contener al menos 6 caracteres';
        }
        return self::$alertas;
    }

    public function nuevo_password() : array {
        if(!$this->password_actual) {
            self::$alertas['error'][] = 'La contraseña actual no puede ir vacio';
        }
        if(!$this->password_nuevo) {
            self::$alertas['error'][] = 'La nueva contraseña no puede ir vacio';
        }
        if(strlen($this->password_nuevo) < 6) {
            self::$alertas['error'][] = 'La contraseña debe contener al menos 6 caracteres';
        }
        return self::$alertas;
    }

    // Comprobar contraseña
    public function comprobar_password() : bool {
        return password_verify($this->password_actual, $this->password );
    }

    // Hashea contraseña
    public function hashPassword() : void {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    // Generar un Token
    public function crearToken() : void {
        $this->token = uniqid();
    }
}