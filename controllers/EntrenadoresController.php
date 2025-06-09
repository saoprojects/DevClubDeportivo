<?php

namespace Controllers;

use MVC\Router;
use Model\Entrenador;
use Classes\Paginacion;
use Intervention\Image\ImageManagerStatic as Image;

class EntrenadoresController {
    public static function index(Router $router) {
        if(!is_admin()) {
            header('Location: /login');
        }

        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if(!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/entrenadores?page=1');
        }
        
        $registros_por_pagina = 9;
        $total = Entrenador::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);

        if($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/entrenadores?page=1');
        }
    
        $entrenador = Entrenador::paginar($registros_por_pagina, $paginacion->offset());

       
        $router->render('admin/entrenadores/index', [
            'titulo' => 'Entrenadores',
             'entrenador' => $entrenador,
             'paginacion' => $paginacion->paginacion()
        ]);
    }
    
    public static function crear(Router $router) {
        if(!is_admin()) {
            header('Location: /login');
        }

        $alertas = [];
        $entrenador = new Entrenador;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_admin()) {
                header('Location: /login');
            }
            
            // Leer la imagen
            if(!empty($_FILES['imagen']['tmp_name'])) {
                
                $carpeta_imagenes = '../public/build/img/entrenadores';

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
           
            $entrenador->sincronizar($_POST);
            
            // Validar
            $alertas = $entrenador->validar();

            // Guardar el registro
            if(empty($alertas)) {
                // Guardar las imagenes
                $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . ".png");
                $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . ".webp");

                // Guardar en la Base de Datos
                $resultado = $entrenador->guardar();
                if ($resultado && is_admin()) {
                    header('Location: /admin/entrenadores');
                } else {
                    header('Location: /');
                }
            }
        }

        $router->render('admin/entrenadores/crear', [
            'titulo' => 'Registrar Entrenador',
            'alertas' => $alertas,
            'entrenador' => $entrenador,
            'redes' => json_decode($entrenador->redes)
        ]);
    }

    public static function editar(Router $router) {
        if(!is_admin()) {
            header('Location: /login');
        }
        $alertas = [];

        // Validar el ID
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if(!$id) {
            header('Location: /admin/entrenadores');
            return;
        }

        // Obtener Entrenador a Editar
        $entrenador = Entrenador::find($id);
        if(!$entrenador) {
            header('Location: /admin/entrenadores');
        }

        // Imagen actual
        $entrenador->imagen_actual = $entrenador->imagen;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_admin()) {
                header('Location: /login');
            }

             // Leer y procesar la imagen
            if(!empty($_FILES['imagen']['tmp_name'])) {
                $carpeta_imagenes = '../public/build/img/entrenadores';

                // Crear la carpeta si no existe
                if(!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0777, true);
                }

                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('webp', 80);

                $nombre_imagen = md5(uniqid(rand(), true));

                $_POST['imagen'] = $nombre_imagen;
            } else {
                $_POST['imagen'] = $entrenador->imagen_actual;
            }
            
            $_POST['redes'] = json_encode( $_POST['redes'], JSON_UNESCAPED_SLASHES );
            // Sincronizar modelo con $_POST
            $entrenador->sincronizar($_POST);
             // Validar
            $alertas = $entrenador->validar();

            if(empty($alertas)) {
                if(isset($nombre_imagen)) {
                    $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . ".png");
                    $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . ".webp");
                }
                // Guardar en la Base de Datos
                $resultado = $entrenador->guardar();
                
                if($resultado) {
                    header('Location: /admin/entrenadores');
                }
            }
        }

        $router->render('admin/entrenadores/editar', [
            'titulo' => 'Actualizar Entrenador',
            'alertas' => $alertas,
            'entrenador' => $entrenador,
            'redes' => json_decode($entrenador->redes)
        ]);
    }

    public static function eliminar() {
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_admin()) {
                header('Location: /login');
            }
            
            $id = $_POST['id'];
            $entrenador = Entrenador::find($id);
            
            if(!isset($entrenador)) {
                header('Location: /admin/entrenadores');
            }
           
            $resultado =  $entrenador->eliminar();
            if($resultado) {
                header('Location: /admin/entrenadores');
            }
        }
    }

    
}
