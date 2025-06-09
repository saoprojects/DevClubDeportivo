<?php

namespace Model;

class InscripcionJugador extends ActiveRecord {
    protected static $tabla = 'inscripciones_jugadores';
    protected static $columnasDB = [
        'id', 'nombre', 'email', 'telefono', 'evento_id', 'estado'
    ];

    public $id;
    public $nombre;
    public $email;
    public $telefono;
    public $evento_id;
    public $estado;
   

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->evento_id = $args['evento_id'] ?? '';
        $this->estado = $args['estado'] ?? '';
    }

    public function validar() {
        // Aquí deberás agregar las validaciones pertinentes para los nuevos campos
        return self::$alertas;
    }
}