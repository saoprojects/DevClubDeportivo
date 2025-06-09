<?php
namespace Model;
class Usuario extends ActiveRecord {
    // Actualiza la tabla y las columnas de la base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = [
    'id', 'dni', 'nombre', 'apellido1', 'apellido2', 'email', 'password', 'confirmado', 
    'estado', 'token', 'admin', 'padre', 'correo_padre', 'madre', 'correo_madre', 'telefono', 'genero', 
    'fecha_nacimiento', 'direccion', 'codigo_postal', 'ciudad', 'pais', 
    'nacionalidad', 'categoria', 'grupo', 'federado', 'nadar',
    'alergias', 'informacion', 'imagen', 'tags', 'redes'
    ];
    // Propiedades del modelo
    public $id;
    public $dni;
    public $nombre;
    public $apellido1;
    public $apellido2;
    public $email;
    public $password;
    public $password2;
    public $confirmado;
    public $estado;
    public $token;
    public $admin;

    public $password_actual;
    public $password_nuevo;

    public $padre;
    public $correo_padre;
    public $madre;
    public $correo_madre;
    public $telefono;
    
    public $genero;
    public $fecha_nacimiento;
    public $direccion;
    public $codigo_postal;
    public $ciudad;
    public $pais;
    public $nacionalidad;
    public $categoria;
    public $grupo;
    public $federado;
    public $nadar;
    public $alergias;
    public $informacion;
    public $imagen;
    public $tags;
    public $redes;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->dni = $args['dni'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido1 = $args['apellido1'] ?? '';
        $this->apellido2 = $args['apellido2'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
        $this->estado = $args['estado'] ?? 'pendiente';
        $this->token = $args['token'] ?? '';
        $this->admin = $args['admin'] ?? 0;

        $this->padre = $args['padre'] ?? '';
        $this->correo_padre = $args['correo_padre'] ?? '';
        $this->madre = $args['madre'] ?? '';
        $this->correo_madre = $args['correo_madre'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->genero = $args['genero'] ?? '';
        $this->fecha_nacimiento = $args['fecha_nacimiento'] ?? '';
        $this->direccion = $args['direccion'] ?? '';
        $this->codigo_postal = $args['codigo_postal'] ?? '';
        $this->ciudad = $args['ciudad'] ?? '';
        $this->pais = $args['pais'] ?? '';

        $this->nacionalidad = $args['nacionalidad'] ?? '';
        $this->categoria = $args['categoria'] ?? '';
        $this->grupo = $args['grupo'] ?? '';
        $this->federado = $args['federado'] ?? null;
        $this->nadar = $args['nadar'] ?? null;
        $this->alergias = $args['alergias'] ?? null;
        $this->informacion = $args['informacion'] ?? null;
        $this->imagen = $args['imagen'] ?? '';
        $this->tags = $args['tags'] ?? '';
        $this->redes = $args['redes'] ?? '';
    }
    
    public function validarLogin() {
        if(!$this->email) {
            self::$alertas['error'][] = 'El Email del Usuario es Obligatorio';
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'Email no válido';
        }
        if(!$this->password) {
            self::$alertas['error'][] = 'El Password no puede ir vacio';
        }
        return self::$alertas;
    }

    public function validar_cuenta() {
        if(!$this->dni) {
            self::$alertas['error'][] = 'El DNI es Obligatorio';
        }
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre es Obligatorio';
        }
        if(!$this->apellido1) {
            self::$alertas['error'][] = 'El Primer Apellido es Obligatorio';
        }
        if(!$this->apellido2) {
            self::$alertas['error'][] = 'El Segundo Apellido es Obligatorio';
        }
        if(!$this->email) {
            self::$alertas['error'][] = 'El Email es Obligatorio';
        }
        if(!$this->password) {
            self::$alertas['error'][] = 'El Password no puede ir vacio';
        }
        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El password debe contener al menos 6 caracteres';
        }
        if($this->password !== $this->password2) {
            self::$alertas['error'][] = 'Los password son diferentes';
        }
        if(!$this->padre) {
            self::$alertas['error'][] = 'El Nombre del Padre es Obligatorio';
        }
        if(!$this->madre) {
            self::$alertas['error'][] = 'El Nombre de la Madre es Obligatorio';
        }
        if(!$this->telefono) {
            self::$alertas['error'][] = 'El Telefono es Obligatorio';
        }
        return self::$alertas;
    }

    public function validarEmail() {
        if(!$this->email) {
            self::$alertas['error'][] = 'El Email es Obligatorio';
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'Email no válido';
        }
        return self::$alertas;
    }

    public function validarPassword() {
        if(!$this->password) {
            self::$alertas['error'][] = 'El Password no puede ir vacio';
        }
        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El password debe contener al menos 6 caracteres';
        }
        return self::$alertas;
    }

    public function nuevo_password() : array {
        if(!$this->password_actual) {
            self::$alertas['error'][] = 'El Password Actual no puede ir vacio';
        }
        if(!$this->password_nuevo) {
            self::$alertas['error'][] = 'El Password Nuevo no puede ir vacio';
        }
        if(strlen($this->password_nuevo) < 6) {
            self::$alertas['error'][] = 'El Password debe contener al menos 6 caracteres';
        }
        return self::$alertas;
    }
    
    // Comprobar el password
    public function comprobar_password() : bool {
        return password_verify($this->password_actual, $this->password );
    }
    // Hashea el password
    public function hashPassword() : void {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }
    // Generar un Token
    public function crearToken() : void {
        $this->token = uniqid();
    }

    public function validar_correos_padres() {
        if($this->correo_padre && !filter_var($this->correo_padre, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'El correo del padre no es válido';
        }
        if($this->correo_madre && !filter_var($this->correo_madre, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'El correo de la madre no es válido';
        }
        return self::$alertas;
    }
}