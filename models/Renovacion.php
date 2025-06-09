<?php
namespace Model;

class Renovacion extends ActiveRecord {
    protected static $tabla = 'renovaciones';
    protected static $columnasDB = ['id', 'usuario_id', 'fecha_solicitud', 'estado', 'fecha_respuesta'];

    public $id;
    public $usuario_id;
    public $fecha_solicitud;
    public $estado;
    public $fecha_respuesta;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->usuario_id = $args['usuario_id'] ?? '';
        $this->fecha_solicitud = $args['fecha_solicitud'] ?? '';
        $this->estado = $args['estado'] ?? 'pendiente';
        $this->fecha_respuesta = $args['fecha_respuesta'] ?? '';
    }
    

}
