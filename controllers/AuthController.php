<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use Intervention\Image\ImageManagerStatic as Image;
use MVC\Router;

class AuthController {
    public static function login(Router $router) {
        
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
            $usuario = new Usuario($_POST);

            $alertas = $usuario->validarLogin();
            
            if(empty($alertas)) {
                // Verificar quel el usuario exista
                $usuario = Usuario::where('email', $usuario->email);
                // if(!$usuario || !$usuario->estado ) {
                //     Usuario::setAlerta('error', 'El Usuario No Existe o no esta aceptado');
                // } else {
                    if(!$usuario || !$usuario->confirmado || $usuario->estado !== 'aceptado' ) {
                        Usuario::setAlerta('error', 'El Usuario No Existe, no está aceptado o no está confirmado');
                    } else {
                    // El Usuario existe
                    if( password_verify($_POST['password'], $usuario->password) ) {
                        
                        // Iniciar la sesión
                        session_start();    
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre;
                        $_SESSION['apellido1'] = $usuario->apellido1;
                        $_SESSION['apellido2'] = $usuario->apellido2;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['admin'] = $usuario->admin ?? null;
                      
                      
                        // Redireccion
                        if($usuario->admin) {
                            header('Location: /admin/dashboard');
                        } else{
                            header('Location: /finalizar-registro');
                        }
                        
                    } else {
                        Usuario::setAlerta('error', 'Password Incorrecto');
                    }

                    
                }
            }
        }
      
        $alertas = Usuario::getAlertas();
        
        // Render a la vista 
        $router->render('auth/login', [
            'titulo' => 'Iniciar Sesión',
            'alertas' => $alertas
        ]);
    }

    public static function logout() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            $_SESSION = [];
            header('Location: /');
        }
       
    }

    public static function registro(Router $router) {
        session_start();
        $alertas = [];
        $usuario = new Usuario;
    
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
    
            // Manejar la carga de la imagen
            if(!empty($_FILES['imagen']['tmp_name'])) {
                $carpeta_imagenes = '../public/build/img/jugadores';
                if(!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0777, true);
                }
    
                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('webp', 80);
                $nombre_imagen = md5(uniqid(rand(), true));
    
                $_POST['imagen'] = $nombre_imagen;
            } else {
                $_POST['imagen'] = '';
            }
    
            // Convertir redes sociales a JSON
            $_POST['redes'] = isset($_POST['redes']) ? json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES) : json_encode([]);
    
            $alertas = $usuario->validar_cuenta();
    
            if(empty($alertas)) {
                // Verificar si el email ya está registrado
                $existeUsuario = Usuario::where('email', $usuario->email);
    
                if($existeUsuario) {
                    Usuario::setAlerta('error', 'El Usuario ya está registrado');
                    $alertas = Usuario::getAlertas();
                } else {
                    // Hashear el password
                    $usuario->hashPassword();
                    unset($usuario->password2);
    
                    // Generar el Token
                    $usuario->crearToken();
    
                    if(isset($nombre_imagen)) {
                        // Guardar las imágenes
                        $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . ".png");
                        $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . ".webp");
                    }
    
                    // Guardar el usuario
                    $resultado = $usuario->guardar();
                    if($resultado) {
                        header('Location: /mensaje');
                    }
                }
            }
        }
    
        // Render a la vista
        $router->render('auth/registro', [
            'titulo' => 'Crea tu cuenta en Club Deportivo',
            'usuario' => $usuario, 
            'alertas' => $alertas
        ]);
    }
    
    // public static function registro(Router $router) {
    //     session_start();
    //     $alertas = [];
    //     $usuario = new Usuario;
    //     if($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $usuario->sincronizar($_POST);
    //     // Convertir redes sociales a JSON (si existen y el usuario es administrador)
    //     if(isset($_SESSION['admin']) && $_SESSION['admin'] && isset($_POST['redes'])) {
    //         $_POST['redes'] = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);
    //     }
    //     // Procesar la imagen (si el usuario es administrador)
    //     if(isset($_SESSION['admin']) && $_SESSION['admin'] && !empty($_FILES['imagen']['tmp_name'])) {
    //         $carpeta_imagenes = '../public/build/img/usuarios';
    //         if(!is_dir($carpeta_imagenes)) {
    //             mkdir($carpeta_imagenes, 0777, true);
    //         }
    //         $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('png', 80);
    //         $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('webp', 80);
    //         $nombre_imagen = md5(uniqid(rand(), true));
    //         $_POST['imagen'] = $nombre_imagen;
    //     }
    //     $alertas = $usuario->validar_cuenta();
    //         if(empty($alertas)) {
    //             $existeUsuario = Usuario::where('email', $usuario->email);
    //             if($existeUsuario) {
    //                 Usuario::setAlerta('error', 'El Usuario ya esta registrado');
    //                 $alertas = Usuario::getAlertas();
    //             } else {
    //                 // Hashear el password
    //                 $usuario->hashPassword();
    //                 // Eliminar password2
    //                 unset($usuario->password2);
    //                 // Generar el Token
    //                 $usuario->crearToken();
    //                  // Guardar la imagen si existe
    //             if(isset($nombre_imagen)) {
    //                 $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . ".png");
    //                 $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . ".webp");
    //             }
    //                 // Crear un nuevo usuario
    //                 $resultado =  $usuario->guardar();
    //                 // Enviar email
    //                 //$email = new Email($usuario->email, $usuario->nombre, $usuario->token);
    //                 //$email->enviarConfirmacion();
    //                 if($resultado) {
    //                     header('Location: /mensaje');
    //                 }
    //             }
    //         }
    //     }
    //     // Render a la vista
    //     $router->render('auth/registro', [
    //         'titulo' => 'Crea tu cuenta en Club Deportivo',
    //         'usuario' => $usuario, 
    //         'alertas' => $alertas
    //     ]);
    // }

    public static function olvide(Router $router) {
        $alertas = [];
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarEmail();

            if(empty($alertas)) {
                // Buscar el usuario
                $usuario = Usuario::where('email', $usuario->email);

                if($usuario && $usuario->confirmado) {

                    // Generar un nuevo token
                    $usuario->crearToken();
                    unset($usuario->password2);

                    // Actualizar el usuario
                    $usuario->guardar();

                    // Enviar el email
                    $email = new Email( $usuario->email, $usuario->nombre, $usuario->token );
                    $email->enviarInstrucciones();


                    // Imprimir la alerta
                    // Usuario::setAlerta('exito', 'Hemos enviado las instrucciones a tu email');

                    $alertas['exito'][] = 'Hemos enviado las instrucciones a tu email';
                } else {
                 
                    // Usuario::setAlerta('error', 'El Usuario no existe o no esta confirmado');

                    $alertas['error'][] = 'El Usuario no existe o no esta confirmado';
                }
            }
        }

        // Muestra la vista
        $router->render('auth/olvide', [
            'titulo' => 'Olvide mi Password',
            'alertas' => $alertas
        ]);
    }

    public static function reestablecer(Router $router) {

        $token = s($_GET['token']);

        $token_valido = true;

        if(!$token) header('Location: /');

        // Identificar el usuario con este token
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {
            Usuario::setAlerta('error', 'Token No Válido, intenta de nuevo');
            $token_valido = false;
        }


        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Añadir el nuevo password
            $usuario->sincronizar($_POST);

            // Validar el password
            $alertas = $usuario->validarPassword();

            if(empty($alertas)) {
                // Hashear el nuevo password
                $usuario->hashPassword();

                // Eliminar el Token
                $usuario->token = null;

                // Guardar el usuario en la BD
                $resultado = $usuario->guardar();

                // Redireccionar
                if($resultado) {
                    header('Location: /login');
                }
            }
        }

        $alertas = Usuario::getAlertas();
        
        // Muestra la vista
        $router->render('auth/reestablecer', [
            'titulo' => 'Reestablecer Password',
            'alertas' => $alertas,
            'token_valido' => $token_valido
        ]);
    }

    public static function mensaje(Router $router) {

        $router->render('auth/mensaje', [
            'titulo' => 'Cuenta Creada Exitosamente'
        ]);
    }

    public static function confirmar(Router $router) {
        
        $token = s($_GET['token']);

        if(!$token) header('Location: /');

        // Encontrar al usuario con este token
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {
            // No se encontró un usuario con ese token
            Usuario::setAlerta('error', 'Token No Válido, la cuenta no se confirmo');
        } else {
            // Confirmar la cuenta
            $usuario->confirmado = 1;
            $usuario->token = '';
            unset($usuario->password2);
            
            // Guardar en la BD
            $usuario->guardar();

            Usuario::setAlerta('exito', 'Cuenta Comprobada Exitosamente');
        }

     

        $router->render('auth/confirmar', [
            'titulo' => 'Confirma tu cuenta en DevClubDeportivo ',
            'alertas' => Usuario::getAlertas()
        ]);
    }
}