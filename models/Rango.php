<?php

namespace Model;

class Rango extends ActiveRecord {
    protected static $tabla = 'rangos';
    protected static $columnasDB = ['id', 'nombre'];

    public $id;
    public $nombre;
}