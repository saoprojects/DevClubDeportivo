<?php

namespace Controllers;

use Model\Dia;
use Model\Hora;
use MVC\Router;
use Model\Rango;
use Model\Evento;
use Model\Categoria;
use Model\Entrenador;
use Model\Patrocinador;

class PaginasController {
    
    public static function index(Router $router) {
        session_start();
        $eventos = Evento::ordenar('hora_id', 'ASC');

        $eventos_formateados = [];
        foreach($eventos as $evento) {
            
            $evento->categoria = Categoria::find($evento->categoria_id);
            $evento->dia = Dia::find($evento->dia_id);
            $evento->hora = Hora::find($evento->hora_id);
            $evento->entrenador = Entrenador::find($evento->entrenador_id);
            
            if($evento->dia_id === "1" && $evento->categoria_id === "1") {
               $eventos_formateados['torneos_v'][] = $evento; 
            }
            
            if($evento->dia_id === "2" && $evento->categoria_id === "1") {
               $eventos_formateados['torneos_s'][] = $evento; 
            }

            if($evento->dia_id === "1" && $evento->categoria_id === "2") {
               $eventos_formateados['campus_v'][] = $evento; 
            }

            if($evento->dia_id === "2" && $evento->categoria_id === "2") {
               $eventos_formateados['campus_s'][] = $evento; 
            }
        }

        // Obtener el total de cada bloque
        $jugadores_total = Entrenador::total();
        $torneos_total = Evento::total('categoria_id', 1);
        $campus_total = Evento::total('categoria_id', 2);

        // Obtener todos los Jugadores o Ponentes

        $jugadores = Entrenador::all();
        
         // Obtener los ID de los rangos
         $rangoOro = Rango::where('nombre', 'Oro');
         $rangoPlata = Rango::where('nombre', 'Plata');
     
         // Obtener Patrocinadores
         $patrocinadores = Patrocinador::all();
         $patrocinadores_formateados = [
             'oro' => [],
             'plata' => []
         ];
     
         foreach ($patrocinadores as $patrocinador) {
             if ($patrocinador->rango_id == $rangoOro->id) {
                 $patrocinadores_formateados['oro'][] = $patrocinador;
             } elseif ($patrocinador->rango_id == $rangoPlata->id) {
                 $patrocinadores_formateados['plata'][] = $patrocinador;
             }
         }
     

        $router->render('paginas/index', [
            'titulo' => 'Inicio',
            'eventos'=> $eventos_formateados,
            'jugadores_total' => $jugadores_total,
            'torneos_total' => $torneos_total,
            'campus_total' => $campus_total,
            'jugadores' => $jugadores,
            'patrocinadores' => $patrocinadores_formateados
        ]);
    }

    public static function evento(Router $router) {
        $router->render('paginas/clubdeportivo', [
            'titulo' => 'Sobre Club Deportivo'
        ]);
    }

    
    
    public static function eventos(Router $router) {
        $eventos = Evento::ordenar('hora_id', 'ASC');

        $eventos_formateados = [];
        foreach($eventos as $evento) {
            
            $evento->categoria = Categoria::find($evento->categoria_id);
            $evento->dia = Dia::find($evento->dia_id);
            $evento->hora = Hora::find($evento->hora_id);
            $evento->entrenador = Entrenador::find($evento->entrenador_id);
            
            if($evento->dia_id === "1" && $evento->categoria_id === "1") {
               $eventos_formateados['torneos_v'][] = $evento; 
            }
            
            if($evento->dia_id === "2" && $evento->categoria_id === "1") {
               $eventos_formateados['torneos_s'][] = $evento; 
            }

            if($evento->dia_id === "1" && $evento->categoria_id === "2") {
               $eventos_formateados['campus_v'][] = $evento; 
            }

            if($evento->dia_id === "2" && $evento->categoria_id === "2") {
               $eventos_formateados['campus_s'][] = $evento; 
            }
        }

        $router->render('paginas/eventos', [
            'titulo' => 'Eventos',
            'eventos'=> $eventos_formateados
        ]);
    }



    public static function detalleEvento(Router $router) {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /404');
            return;
        }
        $evento = Evento::find($id);
        if (!$evento) {
            header('Location: /404');
            return;
        }

        $evento->categoria = Categoria::find($evento->categoria_id);
    
        $router->render('paginas/detalleEvento', [
            'titulo' => 'Evento Club Deportivo',
            'evento' => $evento
        ]);
    }

    public static function paquetes(Router $router) {
        $router->render('paginas/paquetes', [
            'titulo' => 'Paquetes Club Deportivo>'
        ]);
    }
    
    public static function pruebas(Router $router) {
        // Obtener los ID de los rangos
        $rangoOro = Rango::where('nombre', 'Oro');
        $rangoPlata = Rango::where('nombre', 'Plata');
    
        // Obtener Patrocinadores
        $patrocinadores = Patrocinador::all();
        $patrocinadores_formateados = [
            'oro' => [],
            'plata' => []
        ];
    
        foreach ($patrocinadores as $patrocinador) {
            if ($patrocinador->rango_id == $rangoOro->id) {
                $patrocinadores_formateados['oro'][] = $patrocinador;
            } elseif ($patrocinador->rango_id == $rangoPlata->id) {
                $patrocinadores_formateados['plata'][] = $patrocinador;
            }
        }
    
        $router->render('paginas/pruebas', [
            'titulo' => 'Pruebas',
            'patrocinadores' => $patrocinadores_formateados
        ]);
    }
    
    public static function error(Router $router) {
        $router->render('paginas/error', [
            'titulo' => 'Pagina no encontrada',
            
        ]);
    }
}