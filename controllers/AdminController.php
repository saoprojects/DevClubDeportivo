<?php

namespace Controllers;

use MVC\Router;
use Classes\Email;
use Model\Usuario;
use Classes\Paginacion;
use Intervention\Image\ImageManagerStatic as Image;

class AdminController {
    
    public static function index(Router $router) {
        if (!is_admin()) {
            header('Location: /login');
            exit;
        }

        $pagina_actual = $_GET['page'] ?? 1;
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
        if (!$pagina_actual || $pagina_actual < 1) {
            $pagina_actual = 1;
        }

        $por_pagina = 5; // Número de usuarios por página

        // Obtener el total de usuarios pendientes
        $total = Usuario::totalArray(['estado' => 'pendiente']); // Asegúrate de tener un método que cuente usuarios por estado

        $paginacion = new Paginacion($pagina_actual, $por_pagina, $total);

        // Obtener los usuarios pendientes para la página actual
        $offset = $paginacion->offset();
        $usuariosPendientes = Usuario::whereArrayPaginarOrdenar(['estado' => 'pendiente'], $por_pagina, $offset, 'DESC');
        $router->render('admin/panel/index', [
            'titulo' => 'Registro de Usuarios Pendientes',
            'usuariosPendientes' => $usuariosPendientes,
            'paginacion' => $paginacion->paginacion()
        ]);
    }

    public static function aceptarUsuario() {
        if (!is_admin()) {
            header('Location: /login');
            exit;
        }
    
        $id = $_POST['id'] ?? null;
        $id = filter_var($id, FILTER_VALIDATE_INT);
    
        if (!$id) {
            header('Location: /admin/panel?error');
            exit;
        }
    
        // Encuentra el usuario por ID
        $usuario = Usuario::find($id);
        if (!$usuario) {
            header('Location: /admin/panel?error');
            exit;
        }
    
        // Actualizar estado y confirmar el usuario
        $usuario->estado = 'aceptado';
        $usuario->confirmado = 1; // Confirma el usuario automáticamente
        $resultado = $usuario->guardar(); // Guardar los cambios en la base de datos
    
        if ($resultado) {
            // Enviar correo de aceptación
            $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
            $email->enviarNotificacionAceptacion(); // Envía el correo de aceptación
            header('Location: /admin/panel');
        } else {
            header('Location: /admin/panel?error');
        }
        exit;
    }

    public static function rechazarUsuario() {
        if (!is_admin()) {
            header('Location: /login');
            exit;
        }
    
        $id = $_POST['id'] ?? null;
        $id = filter_var($id, FILTER_VALIDATE_INT);
    
        if (!$id) {
            header('Location: /admin/panel?error');
            exit;
        }
    
        // Obtener el usuario
        $usuario = Usuario::find($id);
        if (!$usuario) {
            header('Location: /admin/panel?error');
            exit;
        }
    
        // Enviar correo de rechazo (opcional)
        $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
        $email->enviarNotificacionRechazo(); 
    
        // Eliminar el usuario
        if ($usuario->eliminar()) {
            // Redirigir con mensaje de éxito
            header('Location: /admin/panel');
        } else {
            // Redirigir con mensaje de error
            header('Location: /admin/panel?error');
        }
        exit;
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
            header('Location: /admin/panel');
            exit;
        }

        // Obtener el usuario a editar
        $usuario = Usuario::find($id);
        if (!$usuario) {
            header('Location: /admin/panel');
            exit;
        }

        // Guardar la imagen actual por si no se actualiza
        $usuario->imagen_actual = $usuario->imagen;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Manejo de la carga de la imagen
            if (!empty($_FILES['imagen']['tmp_name'])) {
                
                $carpeta_imagenes = '../public/build/img/jugadores';

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
                    header('Location: /admin/panel');
                }
            }
        }

        $router->render('admin/panel/editar', [
            'titulo' => 'Editar Usuario',
            'alertas' => $alertas,
            'usuario' => $usuario
        ]);
    }
     
    
}
