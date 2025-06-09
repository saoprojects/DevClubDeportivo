<?php

namespace Controllers;

use Classes\Paginacion;
use MVC\Router;
use Model\Patrocinador;
use Model\Rango;
use Intervention\Image\ImageManagerStatic as Image;

class PatrocinadorController {
    public static function index(Router $router) {
        if(!is_admin()) {
            header('Location: /login');
        }
        $pagina_actual = $_GET['page'] ?? 1;
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if(!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/patrocinadores?page=1');
        }

        $por_pagina = 10;
        $total = Patrocinador::total();
        $paginacion = new Paginacion($pagina_actual, $por_pagina, $total);

        $patrocinadores = Patrocinador::paginar($por_pagina, $paginacion->offset());

        foreach($patrocinadores as $patrocinador) {
            $patrocinador->rango = Rango::find($patrocinador->rango_id);
        }
        
        $router->render('admin/patrocinadores/index', [
            'titulo' => 'Patrocinadores',
            'patrocinadores' => $patrocinadores,
            'paginacion' => $paginacion->paginacion()
        ]);
    }

    public static function crear(Router $router) {
        if(!is_admin()) {
            header('Location: /login');
        }
    
        $alertas = [];
        $rangos = Rango::all('ASC');
        $patrocinador = new Patrocinador;
       
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_admin()) {
                header('Location: /login');
            }
    
            // Leer y procesar la imagen del logo
            if(!empty($_FILES['logo']['tmp_name'])) {
                
                $carpeta_logos = '../public/build/img/logos';
    
                // Crear la carpeta si no existe
                if(!is_dir($carpeta_logos)) {
                    mkdir($carpeta_logos, 0777, true);
                }
    
                $imagen_png = Image::make($_FILES['logo']['tmp_name'])->fit(560, 400)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['logo']['tmp_name'])->fit(560, 400)->encode('webp', 80);
    
                $nombre_logo = md5( uniqid( rand(), true) ) . ".png";
    
                $_POST['logo'] = $nombre_logo;
            }
            $_POST['url'] = json_encode( $_POST['url'], JSON_UNESCAPED_SLASHES );
            $patrocinador->sincronizar($_POST);
            // Validar datos del patrocinador
            $alertas = $patrocinador->validar();
    
            if(empty($alertas)) {
                // Guardar las imágenes
                $imagen_png->save($carpeta_logos . '/' . $nombre_logo );
                $imagen_webp->save($carpeta_logos . '/' . $nombre_logo );
                
                // Guardar en la Base de Datos
                $resultado = $patrocinador->guardar();

                if ($resultado && is_admin()) {
                    header('Location: /admin/patrocinadores');
                } else {
                    header('Location: /');
                }
            }
        }
    
        $router->render('admin/patrocinadores/crear', [
            'titulo' => 'Registrar Patrocinador',
            'alertas'=> $alertas,
            'rangos' => $rangos,
            'patrocinador' => $patrocinador,
            'url' => json_decode($patrocinador->url)
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
            header('Location: /admin/patrocinadores');
            return;
        }

         // Obtener Patrocinador a Editar
        $rangos = Rango::all('ASC');
        $patrocinador = Patrocinador::find($id);
        if(!$patrocinador) {
            header('Location: /admin/patrocinadores');
            return;
        }

        $patrocinador->logo_actual = $patrocinador->logo;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_admin()) {
                header('Location: /login');
            }
    
            // Leer y procesar la imagen del logo
            if(!empty($_FILES['logo']['tmp_name'])) {
                $carpeta_logos = '../public/build/img/logos';
    
                // Crear la carpeta si no existe
                if(!is_dir($carpeta_logos)) {
                    mkdir($carpeta_logos, 0777, true);
                }
    
                $imagen_png = Image::make($_FILES['logo']['tmp_name'])->fit(560, 400)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['logo']['tmp_name'])->fit(560, 400)->encode('webp', 80);
    
                
                $nombre_logo = md5( uniqid( rand(), true) ) . ".png";
                $_POST['logo'] = $nombre_logo;
            } else {
                $_POST['logo'] = $patrocinador->logo_actual;
            }

            
            $_POST['url'] = json_encode( $_POST['url'], JSON_UNESCAPED_SLASHES );
            $patrocinador->sincronizar($_POST);
            $alertas = $patrocinador->validar();

            if(empty($alertas)) {
                // Guardar las imágenes
                if(isset($nombre_logo)) {
                    $imagen_png->save($carpeta_logos . '/' . $nombre_logo );
                    $imagen_webp->save($carpeta_logos . '/' . $nombre_logo );
                }
                // Guardar en la Base de Datos
                $resultado = $patrocinador->guardar();

                if($resultado) {
                    header('Location: /admin/patrocinadores');
                    return;
                }
            }
        }

        $router->render('admin/patrocinadores/editar', [
            'titulo' => 'Editar Patrocinador',
            'alertas' => $alertas,
            'rangos' => $rangos,
            'patrocinador' => $patrocinador,
            'url' => json_decode($patrocinador->url)
        ]);
    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_admin()) {
                header('Location: /login');
            }
            
            $id = $_POST['id'] ?? null;
            $patrocinador = Patrocinador::find($id);
            
            if(!$patrocinador) {
                header('Location: /admin/patrocinadores');
                return;
            }
           
            $resultado = $patrocinador->eliminar();
            if($resultado) {
                header('Location: /admin/patrocinadores');
            }
        }
    }
}

