<?php

namespace Model;

class Patrocinador extends ActiveRecord {
    protected static $tabla = 'patrocinadores';
    protected static $columnasDB = ['id', 'nombre', 'descripcion', 'logo', 'rango_id', 'url'];

    public $id;
    public $nombre;
    public $descripcion;
    public $logo; // Ruta de la imagen del logo
    public $rango_id; // Podría ser un valor como 'oro', 'plata', etc.
    public $url; // 

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->logo = $args['logo'] ?? '';
        $this->rango_id = $args['rango'] ?? '';
        $this->url = $args['url'] ?? '';
    }

    // Mensajes de validación para la creación de un patrocinador
    public function validar() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El patrocinador es Obligatorio';
        }
        if(!$this->descripcion) {
            self::$alertas['error'][] = 'La descripción del patrocinador es Obligatoria';
        }
        if(!$this->rango_id) {
            self::$alertas['error'][] = 'El rango del patrocinador es Obligatorio';
        }
        if(!$this->url) {
            self::$alertas['error'][] = 'La URL del patrocinador es Obligatoria';
        }
        // Validación para el logo si es necesario
        // Por ejemplo, verificar si se ha cargado un archivo válido

        return self::$alertas;
    }

    // Aquí podrías agregar otros métodos específicos para manejar la lógica de los patrocinadores
}
?>
