<?php

namespace Controllers;

use Model\Registro;
use Model\Equipacion;

class APIEquipacion {

    public static function index() {
        
        if(!is_admin()) {
            echo json_encode([]);
            return;
        }


        $equipaciones = Equipacion::all();
        
        foreach($equipaciones as $equipacion) {
            $equipacion->total = Registro::totalArray(['equipacion_id' => $equipacion->id, 'paquete_id' => "1"]);
        }
        
        header('Content-Type: application/json');
        echo json_encode($equipaciones);
        return;
    }
}