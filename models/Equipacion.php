<?php 

namespace Model;

class Equipacion extends ActiveRecord {
    protected static $tabla = 'equipacion';
    protected static $columnasDB = ['id', 'nombre'];

    public $id;
    public $nombre;
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
    }

}