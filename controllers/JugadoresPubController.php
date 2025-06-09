<?php

namespace Controllers;

use MVC\Router;
use Model\Jugador;
use Classes\Paginacion;
use Intervention\Image\ImageManagerStatic as Image;

class JugadoresPubController {
    public static function index(Router $router) {
        if(!is_admin()) {
            header('Location: /login');
        }

        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if(!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/panel?page=1');
        }
        
        $registros_por_pagina = 10;
        $total = Jugador::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);

        if($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/panel?page=1');
        }
    
        $jugador = Jugador::paginar($registros_por_pagina, $paginacion->offset());

       
        $router->render('/admin/panel/index', [
            'titulo' => 'Notificaciones de Registro',
             'jugador' => $jugador,
             'paginacion' => $paginacion->paginacion()
        ]);
    }
    
    public static function crear(Router $router) {
        
        $alertas = [];
        $jugador = new Jugador;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // Leer la imagen
            if(!empty($_FILES['imagen']['tmp_name'])) {
                
                $carpeta_imagenes = '../public/build/img/jugadores';

                // Crear la carpeta si no existe
                if(!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0777, true);
                }

                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('webp', 80);

                $nombre_imagen = md5(uniqid(rand(), true));

                $_POST['imagen'] = $nombre_imagen;
            }
            $_POST['redes'] = json_encode( $_POST['redes'], JSON_UNESCAPED_SLASHES );     
            $jugador->sincronizar($_POST);
            
            // Validar
            $alertas = $jugador->validar();

            // Guardar el registro
            if(empty($alertas)) {
                // Guardar las imagenes
                $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . ".png");
                $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . ".webp");

                // Guardar en la Base de Datos
                $jugador->estado = 'pendiente';
                $resultado = $jugador->guardar();
                if ($resultado && is_admin()) {
                    header('Location: /admin/panel');
                } else {
                    header('Location: /confirmacion');
                }
            }
        }

        $router->render('inscripciones/jugadores/crear', [
            'titulo' => 'Registrar Jugador',
            'alertas' => $alertas,
            'jugador' => $jugador,
            'redes' => json_decode($jugador->redes)
        ]);
    }

    public static function registroExitoso(Router $router) {
    $router->render('inscripciones/confirmacion', [
        'titulo' => 'Registro Exitoso'
        ]);
    }

    
}

