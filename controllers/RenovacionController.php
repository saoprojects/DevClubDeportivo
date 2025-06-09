<?php

namespace Controllers;

use MVC\Router;
use Classes\Email;
use Model\Usuario;
use Model\Renovacion;
use Classes\Paginacion;

class RenovacionController {

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

        $por_pagina = 10; // Número de renovaciones por página

        // Obtener el total de renovaciones pendientes
        $total = Renovacion::totalArray(['estado' => 'pendiente']);

        $paginacion = new Paginacion($pagina_actual, $por_pagina, $total);

        // Obtener las renovaciones pendientes para la página actual
        $offset = $paginacion->offset();
        $renovacionesPendientes = Renovacion::whereArrayPaginarOrdenar(['estado' => 'pendiente'], $por_pagina, $offset, 'DESC');

        // Añadir datos del usuario a cada renovación
        foreach ($renovacionesPendientes as $renovacion) {
            $usuario = Usuario::find($renovacion->usuario_id);
            $renovacion->usuario = $usuario;
        }

        $router->render('admin/renovaciones/index', [
            'titulo' => 'Gestión de Renovaciones',
            'renovacionesPendientes' => $renovacionesPendientes,
            'paginacion' => $paginacion->paginacion()
        ]);
    }

    
       
    public static function aceptarRenovacion() {
        if (!is_admin()) {
            header('Location: /login');
            exit;
        }

        $id = $_POST['id'] ?? null;
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            header('Location: /admin/renovaciones?error');
            exit;
        }

        $renovacion = Renovacion::find($id);
        if (!$renovacion) {
            header('Location: /admin/renovaciones?error');
            exit;
        }

        $usuario = Usuario::find($renovacion->usuario_id);
        if (!$usuario) {
            header('Location: /admin/renovaciones?error');
            exit;
        }
        date_default_timezone_set('Europe/Madrid');
        // Aceptar la renovación y actualizar la fecha de respuesta
        $renovacion->estado = 'aceptada';
        $renovacion->fecha_respuesta = date('Y-m-d H:i:s');
        $resultado = $renovacion->guardar();

        if ($resultado) {
            // Enviar correo de notificación de aceptación
            $email = new Email($usuario->email, $usuario->nombre, '');

            $email->enviarNotificacionRenovacionAceptada();
            
            header('Location: /admin/renovaciones?exito');
        } else {
            header('Location: /admin/renovaciones?error');
        }
        exit;
    }

    public static function rechazarRenovacion() {
        if (!is_admin()) {
            header('Location: /login');
            exit;
        }

        $id = $_POST['id'] ?? null;
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            header('Location: /admin/renovaciones?error');
            exit;
        }

        $renovacion = Renovacion::find($id);
        if (!$renovacion) {
            header('Location: /admin/renovaciones?error');
            exit;
        }

        $usuario = Usuario::find($renovacion->usuario_id);
        if (!$usuario) {
            header('Location: /admin/renovaciones?error');
            exit;
        }

        // Rechazar la renovación y actualizar la fecha de respuesta
        $renovacion->estado = 'rechazada';
        $renovacion->fecha_respuesta = date('Y-m-d H:i:s');
        $resultado = $renovacion->guardar();

        if ($resultado) {
            // Enviar correo de notificación de rechazo
            $email = new Email($usuario->email, $usuario->nombre, '');
            $email->enviarNotificacionRenovacionRechazada();
            
            header('Location: /admin/renovaciones?exito');
        } else {
            header('Location: /admin/renovaciones?error');
        }
        exit;
    }
    
   
}

