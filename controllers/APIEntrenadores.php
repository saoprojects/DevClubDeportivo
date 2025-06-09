<?php

namespace Controllers;

use Model\Entrenador;

class APIEntrenadores {
    
    public static function index() {
        $entrenadores = Entrenador::all();
        echo json_encode($entrenadores);
    }

    public static function entrenador() {
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if(!$id || $id < 1 ) {
            echo json_encode([]);
            return;
        }

        $entrenadores = Entrenador::find($id);
        echo json_encode($entrenadores, JSON_UNESCAPED_SLASHES);
    }
}