<?php

namespace Model;

class Entrenador extends ActiveRecord {
    // Asegúrate de que el nombre de la tabla refleje el cambio en la base de datos
    protected static $tabla = 'entrenadores';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'carnet_entrenador', 'email', 'telefono', 'imagen', 'redes'];

    public $id;
    public $nombre;
    public $apellido;
    public $carnet_entrenador;
    public $email;
    public $telefono;
    public $imagen;
    public $redes;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->carnet_entrenador = $args['carnet_entrenador'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->redes = $args['redes'] ?? '';
    }

    public function validar() {
        // Agrega aquí las validaciones para los campos nuevos
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre es Obligatorio';
        }
        // ... otras validaciones ...
        return self::$alertas;
    }
}
