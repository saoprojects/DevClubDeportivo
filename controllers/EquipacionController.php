<?php

namespace Controllers;

use MVC\Router;

class EquipacionController {
   

    public static function index(Router $router) {
        if(!is_admin()) {
            header('Location: /login');
        }
        $router->render('admin/equipacion/index', [
            'titulo' => 'Equipacion'
        ]);
    }
}