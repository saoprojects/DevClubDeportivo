<?php

namespace Controllers;

use MVC\Router;
use Model\Paquete;
use Model\Usuario;
use Model\Registro;
use Classes\Paginacion;
use Intervention\Image\ImageManagerStatic as Image;

class RegistradosController {
    public static function index(Router $router) {
        if(!is_admin()) {
            header('Location: /login');
        } 

        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if(!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/registrados?page=1');
        }
        $registros_por_pagina = 9;
        $total = Registro::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);


        if($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/registrados?page=1');
        } 
        
        

        $registros = Registro::paginar($registros_por_pagina, $paginacion->offset());
        foreach($registros as $registro) {
            $registro->usuario = Usuario::find($registro->usuario_id);
            $registro->paquete = Paquete::find($registro->paquete_id);
        }

        $router->render('admin/registrados/index', [
            'titulo' => 'Usuarios Registrados',
            'registros' => $registros,
            'paginacion' => $paginacion->paginacion()
        ]);
    }

    public static function editar(Router $router) {
        if (!is_admin()) {
            header('Location: /login');
            exit;
        }

        $alertas = [];

        // Validar el ID del usuario
        $id = $_GET['id'] ?? null;
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            header('Location: /admin/registrados');
            exit;
        }

        // Obtener el usuario a editar
        $usuario = Usuario::find($id);
        if (!$usuario) {
            header('Location: /admin/registrados');
            exit;
        }

        // Guardar la imagen actual por si no se actualiza
        $usuario->imagen_actual = $usuario->imagen;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Manejo de la carga de la imagen
            if (!empty($_FILES['imagen']['tmp_name'])) {
                
                $carpeta_imagenes = '../public/build/img/usuarios';

                // Crear la carpeta si no existe
                if(!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0777, true);
                }

                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('webp', 80);

                $nombre_imagen = md5(uniqid(rand(), true));

                $_POST['imagen'] = $nombre_imagen;
            } else {
                $_POST['imagen'] = $usuario->imagen_actual;
            }

            $_POST['redes'] = json_encode( $_POST['redes'], JSON_UNESCAPED_SLASHES );  
            $usuario->sincronizar($_POST);
            
            $alertas = $usuario->validar();

            if(empty($alertas)) {
                if(isset($nombre_imagen)) {
                    $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . ".png");
                    $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . ".webp");
                }

                // Guardar el usuario
                $resultado = $usuario->guardar();
                
                if ($resultado) {
                    header('Location: /admin/registrados');
                }
            }
        }

        $router->render('admin/registrados/editar', [
            'titulo' => 'Editar Usuario',
            'alertas' => $alertas,
            'usuario' => $usuario,
            'redes' => json_decode($usuario->redes)
        ]);
    }
     
}