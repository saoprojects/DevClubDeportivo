<?php

namespace Model;

class InscripcionClub  extends ActiveRecord {
    protected static $tabla = 'inscripciones_clubs';
    protected static $columnasDB = [
        'id', 'nombre_club', 'informacion_contacto', 'evento_id', 'estado'
    ];

    public $id;
    public $nombre_club;
    public $informacion_contacto;
    public $evento_id;
    public $estado;
    

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre_club = $args['nombre_club'] ?? '';
        $this->informacion_contacto = $args['informacion_contacto'] ?? '';
        $this->evento_id = $args['evento_id'] ?? '';
        $this->estado = $args['estado'] ?? '';
    }

    public function validar() {
        // Aquí deberás agregar las validaciones pertinentes para los nuevos campos
        return self::$alertas;
    }
}