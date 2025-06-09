<?php

namespace Controllers;
session_start();

use Model\Dia;
use Model\Hora;
use MVC\Router;
use Model\Firma;
use Model\Renovacion;
use Model\Evento;
use Classes\Email;
use Model\Jugador;
use Model\Paquete;
use Model\Usuario;
use Model\Registro;
use Model\Categoria;
use Model\Equipacion;
use Model\EventosRegistros;

class RegistroController {
    
    public static function crear(Router $router) {
        if(!is_auth()) {
            header('Location: /');
            return;
        }

        // Verificar si el usuario ya esta registrado
        $registro = Registro::where('usuario_id', $_SESSION['id']);

        if(isset($registro) && ($registro->paquete_id === "3" || $registro->paquete_id === "2" )) {
            header('Location: /boleto?id=' . urlencode($registro->token));
            return;
        }

        if(isset($registro) && $registro->paquete_id === "1") {
            header('Location: /finalizar-registro/eventosconf');
            return;
        }

        $router->render('registro/crear', [
            'titulo' => 'Finalizar Registro'
        ]);
    }

    public static function gratis(Router $router) {

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_auth()) {
                header('Location: /login');
                return;
            }

              // Verificar si el usuario ya esta registrado
              $registro = Registro::where('usuario_id', $_SESSION['id']);
              if(isset($registro) && $registro->paquete_id === "3") {
                  header('Location: /boleto?id=' . urlencode($registro->token));
                  return;
              }
            
            $token = substr( md5(uniqid( rand(), true )), 0, 8);
            
            // Crear registro
            $datos = array(
                'paquete_id' => 3,
                'pago_id' => '',
                'token' => $token,
                'usuario_id' => $_SESSION['id']
            );

            $registro = new Registro($datos);
            $resultado = $registro->guardar();

            if($resultado) {
                header('Location: /boleto?id=' . urlencode($registro->token));
                return;
            }

        }
    }

    public static function boleto(Router $router) {
        if(!is_auth()) {
            header('Location: /');
            return;
        }
         // Validar la URL
         $id = $_GET['id'];

         if(!$id || !strlen($id) === 8 ) {
             header('Location: /');
             return;
         }
 
         // buscarlo en la BD
         $registro = Registro::where('token', $id);
         if(!$registro) {
             header('Location: /');
             return;
         }
        
         // Llenar las tablas de referencia
         $registro->usuario = Usuario::find($registro->usuario_id);
         $registro->paquete = Paquete::find($registro->paquete_id);
        
       // Verificar si el usuario ya ha firmado
        $usuarioId = $_SESSION['id'];
        $firma = Firma::where('usuario_id', $usuarioId);

        // Definir una variable para el mensaje
        $mensajeFirma = '';

        // Si existe una firma y está confirmada, establecer el mensaje
        if ($firma && $firma->estado == 'confirmado') {
            $mensajeFirma = 'Los documentos ya han sido firmados.';
        }

        // Pasar variables a la vista
        $router->render('registro/boleto', [
            'titulo' => 'Area Privada',
            'registro' => $registro,
            'mensajeFirma' => $mensajeFirma
        ]);
    }

    public static function pagar(Router $router) {

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_auth()) {
                header('Location: /login');
                return;
            }

            // Validar que Post no venga vacio
            if(empty($_POST)) {
                echo json_encode([]);
                return;
            }

            // Crear el registro
            $datos = $_POST;
            $datos['token'] = substr( md5(uniqid( rand(), true )), 0, 8);
            $datos['usuario_id'] = $_SESSION['id'];
            
            try {
                $registro = new Registro($datos);
          
                $resultado = $registro->guardar();
                echo json_encode($resultado);
            } catch (\Throwable $th) {
                echo json_encode([
                    'resultado' => 'error'
                ]);
            }

        }
    }

    public static function eventosconf(Router $router) {
        if(!is_auth()) {
            header('Location: /login');
            return;
        }

        // Validar que el usuario tenga el plan presencial
        $usuario_id = $_SESSION['id'];
        $registro = Registro::where('usuario_id', $usuario_id);
        
        if(isset($registro) && $registro->paquete_id === "2") {
            header('Location: /boleto?id=' . urlencode($registro->token));
            return;
        }

        if($registro->paquete_id !== "1") {
            header('Location: /');
            return;
        }

        // Redireccionar a boleto virtual en caso de haber finalizado su registro
        if(isset($registro->equipacion_id) && $registro->paquete_id === "1") {
            header('Location: /boleto?id=' . urlencode($registro->token));
             return;
        }


        $eventos = Evento::ordenar('hora_id', 'ASC');

        $eventos_formateados = [];
        foreach($eventos as $evento) {
            
            $evento->categoria = Categoria::find($evento->categoria_id);
            $evento->dia = Dia::find($evento->dia_id);
            $evento->hora = Hora::find($evento->hora_id);
            $evento->jugador = Jugador::find($evento->jugador_id);
            
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

        $equipacion = Equipacion::all('ASC');

        // Manejando el registro mediante POST

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // Revisar que el usuario este autenticado
            if(!is_auth()) {
                header('Location: /login');
                return;
            }

            $eventos = explode(',', $_POST['eventos']);
            
            if(empty($eventos)) {
                echo json_encode(['resultado' => false]);
                return;
            }

            // Obtener el registro de usuario
            $registro = Registro::where('usuario_id', $_SESSION['id']);
           
            if(!isset($registro) || $registro->paquete_id !== "1") {
                echo json_encode(['resultado' => false]);
                return;
            }

            $eventos_array = [];
            // Validar la disponibilidad de los eventos seleccionados
            foreach($eventos as $evento_id) {
                $evento = Evento::find($evento_id);
                
                // Comprobar que el evento exista
                if(!isset($evento) || $evento->disponibles === "0") {
                    echo json_encode(['resultado' => false]);
                    return;
                }
                $eventos_array[] = $evento;
            }
                
            foreach($eventos_array as $evento) {
                $evento->disponibles -= 1;
                $evento->guardar();

                // Almacenar el registro
                $datos = [
                    'evento_id' =>  (int) $evento->id,
                    'registro_id' => (int)  $registro->id
                ];

                $registro_usuario = new EventosRegistros($datos);
                $registro_usuario->guardar();
            }

            // Almacenar el regalo
            $registro->sincronizar(['equipacion_id' => $_POST['equipacion_id']]);
            $resultado = $registro->guardar();

            if($resultado) {
                echo json_encode([
                    'resultado' => $resultado, 
                    'token' => $registro->token
                ]);
            } else {
                echo json_encode(['resultado' => false]);
            }

            return;
        }

        $router->render('registro/eventosconf', [
            'titulo' => 'Eligie un evento en ClubDeportivo',
            'eventos' => $eventos_formateados,
            'equipacion' => $equipacion
            
        ]);
   }

    // public static function guardarFirma(Router $router) {
    //     if (!is_auth()) {
    //         header('Location: /');
    //         return;
    //     }

    //     if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //         $usuarioId = $_SESSION['id'];
            
    //         // Recuperar el registro del usuario para obtener su token
    //         $registro = Registro::where('usuario_id', $usuarioId);
    //         if (!$registro) {
    //             echo "No se encontró el registro del usuario.";
    //             exit; // O manejar este caso como prefieras
    //         }

    //         // Recolectar datos del formulario
    //         $autorizacionEnvioComu = $_POST["envioComu"];
    //         $autorizacionImgRDS = $_POST["imgRDS"];
    //         $autorizacionImgPWeb = $_POST["imgPWeb"];
    //         $autorizacionImgStr = $_POST["imgStr"];
    //         $autorizacionIWHATS = $_POST["iWHATS"];
    //         $clienteIp = $_SERVER["REMOTE_ADDR"];
    //         $hora = date("Y-m-d H:i:s");

    //         $firma = new Firma([
    //             'nombre' => $_SESSION['nombre'],
    //             'apellido1' => $_SESSION['apellido1'],
    //             'envioComu' => $autorizacionEnvioComu,
    //             'imgRDS' => $autorizacionImgRDS,
    //             'imgPWeb' => $autorizacionImgPWeb,
    //             'imgStr' => $autorizacionImgStr,
    //             'iWHATS' => $autorizacionIWHATS,
    //             'ip' => $clienteIp,
    //             'hora' => $hora,
    //             'usuario_id' => $usuarioId,
    //             'token' => $registro->token, // Usar el token del registro
    //             'estado' => 'pendiente'
    //         ]);

    //         $errores = $firma->validar();

    //         if (empty($errores)) {
    //             $resultado = $firma->guardar();

    //             if ($resultado) {
    //                 $email = new Email($_SESSION['email'], $_SESSION['nombre'], $registro->token);
    //                 $email->enviarCorreoConfirmacionFirma($registro->token);
    //                 header('Location: /firma');
    //                 exit;
    //             } else {
    //                 echo "Error al guardar la firma en la base de datos.";
    //             }
    //         } else {
    //             foreach ($errores as $error) {
    //                 echo $error . "<br>";
    //             }
    //         }
    //     }

    //     $router->render('registro/firma', [
    //         'titulo' => 'Documentos'
    //     ]);
    // }

    public static function guardarFirma(Router $router) {
        if (!is_auth()) {
            header('Location: /');
            return;
        }
    
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $usuarioId = $_SESSION['id'];
            
             // Recuperar el usuario para obtener los correos del padre y la madre
            $usuario = Usuario::find($usuarioId);
            if (!$usuario) {
                echo "No se encontró el usuario.";
                exit;
            }
            // Recuperar el registro del usuario para obtener su token
            $registro = Registro::where('usuario_id', $usuarioId);
            if (!$registro) {
                echo "No se encontró el registro del usuario.";
                exit;
            }
    
           // Recolectar datos del formulario
           $autorizacionEnvioComu = $_POST["envioComu"];
           $autorizacionImgRDS = $_POST["imgRDS"];
           $autorizacionImgPWeb = $_POST["imgPWeb"];
           $autorizacionImgStr = $_POST["imgStr"];
           $autorizacionIWHATS = $_POST["iWHATS"];
           $clienteIp = $_SERVER["REMOTE_ADDR"];
           $hora = date("Y-m-d H:i:s");
           date_default_timezone_set('Europe/Madrid');

            $firma = new Firma([

                'nombre' => $_SESSION['nombre'],
                'apellido1' => $_SESSION['apellido1'],
                'envioComu' => $autorizacionEnvioComu,
                'imgRDS' => $autorizacionImgRDS,
                'imgPWeb' => $autorizacionImgPWeb,
                'imgStr' => $autorizacionImgStr,
                'iWHATS' => $autorizacionIWHATS,
                'ip' => $clienteIp,
                'hora' => $hora,
                'usuario_id' => $usuarioId,
                'token' => $registro->token, // Usar el token del registro
                'token_padre' => '',
                'token_madre' => '', 
                'estado' => 'pendiente',
                'confirmacion_padre' => 'pendiente',
                'confirmacion_madre' => 'pendiente'
            ]);
    
            $firma->crearTokensPadres(); // Genera tokens para padres
            $errores = $firma->validar();
    
            if (empty($errores)) {
                $resultado = $firma->guardar();
    
                if ($resultado) {
                    // Ruta al PDF
                    // Ruta al PDF
                    $rutaPDF = $_SERVER['DOCUMENT_ROOT'] . '/build/pdf/Tratamiento.pdf';
    
                    // Enviar correo al padre
                    $emailPadre = new Email($usuario->correo_padre, $usuario->padre, $firma->token_padre);
                    $emailPadre->enviarCorreoConfirmacionFirma($firma->token_padre, $rutaPDF);
    
                    // Enviar correo a la madre
                    $emailMadre = new Email($usuario->correo_madre, $usuario->madre, $firma->token_madre);
                    $emailMadre->enviarCorreoConfirmacionFirma($firma->token_madre, $rutaPDF);
                    
                    header('Location: /firma');
                    exit;
                } else {
                    echo "Error al guardar la firma en la base de datos.";
                }
            } else {
                foreach ($errores as $error) {
                    echo $error . "<br>";
                }
            }
        }
    
        $router->render('registro/firma', [
            'titulo' => 'Documentos
            ']);
    }
    
    

   public static function firma(Router $router) {
    
        $router->render('registro/firma', [
            'titulo' => 'Firma Creada Exitosamente',
            ]);

    }

    public static function confirmarFirma(Router $router) {
        if (!is_auth()) {
            header('Location: /login');
            exit;
        }
    
        $token = $_GET['token'] ?? null;
    
        if (!$token) {
            echo "Error: Token no proporcionado.";
            exit;
        }
    
        // Intentar buscar la firma usando el token del padre o de la madre
        $firma = Firma::where('token_padre', $token) ?? Firma::where('token_madre', $token);
        
        if (!$firma) {
            echo "Firma no encontrada con el token proporcionado.";
            exit;
        }
    
        // Verificar y actualizar el estado de la firma y la confirmación del padre/madre
        if ($firma->confirmacion_padre == 'pendiente' && $firma->token_padre == $token) {
            $firma->confirmacion_padre = 'confirmado';
        }
    
        if ($firma->confirmacion_madre == 'pendiente' && $firma->token_madre == $token) {
            $firma->confirmacion_madre = 'confirmado';
        }
    
        // Si ambos padres han confirmado, cambiar el estado general de la firma a 'confirmado'
        if ($firma->confirmacion_padre == 'confirmado' && $firma->confirmacion_madre == 'confirmado') {
            $firma->estado = 'confirmado';
        }
    
        $firma->guardar();
        Firma::setAlerta('exito', 'Firma Comprobada Exitosamente');
    
        $router->render('registro/confirmar-firma', [
            'titulo' => 'Confirma tu firma en Club Deportivo',
            'alertas' => Firma::getAlertas()
        ]);
    }
    
    
    

    // public static function confirmarFirma(Router $router) {
    //     if (!is_auth()) {
    //         header('Location: /login');
    //         exit;
    //     }
    
    //     $token = $_GET['token'] ?? null;
    
    //     if (!$token) {
    //         // Manejar error: Token no proporcionado
    //         exit;
    //     }
    
    //     // Buscar la firma usando el token
    //     $firma = Firma::where('token', $token);
        
    //     $firma && $firma->estado == 'pendiente';
    //     $firma->estado = 'confirmado';
    //     $firma->guardar();

    //     if($firma->estado == 'confirmado'){
    //         Firma::setAlerta('exito', 'Firma Comprobada Exitosamente');
    //     }else{
    //         Firma::setAlerta('error', 'La firma ya ha sido confirmada o no está pendiente');
    //     }
        
    //     $router->render('registro/confirmar-firma', [
    //         'titulo' => 'Confirma tu firma en Club Deportivo',
    //         'alertas' => Firma::getAlertas()
    //     ]);
    // }

    public static function solicitarRenovacion(Router $router) {
        if (!is_auth()) {
            header('Location: /login');
            exit;
        }
    
        $usuario_id = $_SESSION['id'] ?? null;
        $renovacionExitosa = false;
        $huboError = false;
        $mensajeError = '';
        date_default_timezone_set('Europe/Madrid');

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $usuario_id) {
            // Verificar si ya se ha hecho una solicitud de renovación este año
            $anioActual = date('Y');
            $renovacionExistente = Renovacion::where('usuario_id', $usuario_id, "YEAR(fecha_solicitud) = ${anioActual}");
    
            if ($renovacionExistente) {
                $huboError = true;
                $mensajeError = 'Ya has realizado una solicitud de renovación este año.';
            } else {
                // Crear una nueva solicitud de renovación
                $renovacion = new Renovacion([
                    'usuario_id' => $usuario_id,
                    'fecha_solicitud' => date("Y-m-d H:i:s"),
                    'estado' => 'pendiente',
                    'fecha_respuesta' => date("Y-m-d H:i:s")
                ]);
              
                // Intentar guardar la renovación
                $resultado = $renovacion->guardar();
                
                if ($resultado['resultado']) {
                    $renovacionExitosa = true;
                } else {
                    $huboError = true;
                    $mensajeError = 'Hubo un error al procesar la solicitud de renovación.';
                }
            }
        }
    
        // Pasar variables a la vista
        $router->render('registro/renovacion', [
            'titulo' => 'Solicitud de Renovación',
            'renovacionExitosa' => $renovacionExitosa,
            'huboError' => $huboError,
            'mensajeError' => $mensajeError
          
        ]);
    }
    
    
    

}
    
    
    
