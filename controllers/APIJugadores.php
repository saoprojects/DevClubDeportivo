<?php

namespace Controllers;

use Model\Entrenador;
use Model\Jugador;

class APIJugadores {
    
    public static function index() {
        $jugadores = Entrenador::all();
        echo json_encode($jugadores);
    }

    public static function jugador() {
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if(!$id || $id < 1 ) {
            echo json_encode([]);
            return;
        }

        $jugador = Entrenador::find($id);
        echo json_encode($jugador, JSON_UNESCAPED_SLASHES);
    }
}