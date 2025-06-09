<?php

namespace Classes;

use Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $mailer;
    public $nombre;
    public $token;
    public $rutaLogo;
    
    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
        $this->rutaLogo = 'https://denemax.es/wp-content/uploads/2020/12/logo-1.png'; // Cambia esto por la ruta real del logo
    }

    public function enviarConfirmacion() {
         // create a new object
         $mail = new PHPMailer();
         $mail->isSMTP();
         $mail->Host = $_ENV['EMAIL_HOST'];
         $mail->SMTPAuth = true;
         $mail->Port = $_ENV['EMAIL_PORT'];
         $mail->Username = $_ENV['EMAIL_USER'];
         $mail->Password = $_ENV['EMAIL_PASS'];
     
         $mail->setFrom('cuentas@devwebcamp.com');
         $mail->addAddress($this->email, $this->nombre);
         $mail->Subject = 'Confirma tu Cuenta';

         // Set HTML
         $mail->isHTML(TRUE);
         $mail->CharSet = 'UTF-8';

         $contenido = '<html>';
         $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong> Has Registrado Correctamente tu cuenta en DevWebCamp; pero es necesario confirmarla</p>";
         $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['HOST'] . "/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a>";       
         $contenido .= "<p>Si tu no creaste esta cuenta; puedes ignorar el mensaje</p>";
         $contenido .= "<p><img src='{$this->rutaLogo}' alt='Logo de la Empresa'></p>"; // Incluir el logo
         $contenido .= '</html>';
         $mail->Body = $contenido;

         //Enviar el mail
         $mail->send();

    }
    
    public function enviarInstrucciones() {

        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
    
        $mail->setFrom('cuentas@devwebcamp.com');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Reestablece tu password';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong> Has solicitado reestablecer tu password, sigue el siguiente enlace para hacerlo.</p>";
        $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['HOST'] . "/reestablecer?token=" . $this->token . "'>Reestablecer Password</a>";        
        $contenido .= "<p>Si tu no solicitaste este cambio, puedes ignorar el mensaje</p>";
        $contenido .= "<p><img src='{$this->rutaLogo}' alt='Logo de la Empresa'></p>"; // Incluir el logo
        $contenido .= '</html>';
        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();
    } //////////  RECUPERACION DE CONTRASEÑA ////////// 

    ///////////// CONFIRMAR CUENTA AL SER ACEPTADO EN EL CLUB /////////////
    public function enviarNotificacionAceptacion() {
        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
    
        $mail->setFrom('cuentas@devwebcamp.com');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Cuenta Aceptada en Club Deportivo';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';
        
        // Configuración del SMTP y otros ajustes (similar a los otros métodos)
        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong>, tu cuenta en Club Deportivo ha sido aceptada.</p>";
        $contenido .= "<p>Ahora puedes iniciar sesión y disfrutar de nuestros servicios.</p>";
        $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['HOST'] . "/login" . "'>Iniciar Sesion</a>";
        $contenido .= "<p><img src='{$this->rutaLogo}' alt='Logo de la Empresa'></p>"; // Incluir el logo
        $contenido .= '</html>';
        $mail->Body = $contenido;
        $mail->send();
    }


    /// ENVIAR NOTIFICACION DE RECHAZO DEL CLUB //////////////////
    public function enviarNotificacionRechazo() {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
    
        $mail->setFrom('cuentas@devwebcamp.com');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Cuenta Rechazada en Club Deportivo';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';
        // Configuración del SMTP y otros ajustes (similar a los otros métodos)
        
        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong>, lamentablemente tu solicitud de cuenta en Club Deportivo ha sido rechazada.</p>";
        $contenido .= "<p>Para más información, puedes contactarnos.</p>";
        $contenido .= "<p><img src='{$this->rutaLogo}' alt='Logo de la Empresa'></p>"; // Incluir el logo
        $contenido .= '</html>';
        $mail->Body = $contenido;
        $mail->send();
    }

   
   
    ///// FIRMAS DE LOS PADRES Y MADRES ///////////////////////

    public function enviarCorreoConfirmacionFirma($token, $rutaPDF) {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
        $mail->setFrom('cuentas@clubdeportivo.com');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Confirmación de Firma';
    
        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong>, por favor confirma tu firma en el siguiente enlace.</p>";
        $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['HOST'] . "/confirmar-firma?token=" . $token . "'>Confirmar Firma</a></p>";
        $contenido .= "<p>Si no has solicitado esto, puedes ignorar este mensaje.</p>";
        $contenido .= "<p><img src='{$this->rutaLogo}' alt='Logo de la Empresa'></p>"; // Incluir el logo
        $contenido .= '</html>';
        $mail->Body = $contenido;
    
        // // Adjuntar PDF si existe
        // if (file_exists($rutaPDF)) {
        //     $mail->addAttachment($rutaPDF, 'Tratamiento.pdf');
        // }
    
        // // Enviar el correo
        // $mail->send();

         // Adjuntar PDF si existe
        if (file_exists($rutaPDF)) {
            $mail->addAttachment($rutaPDF, 'Tratamiento.pdf');
        } else {
            error_log("No se pudo encontrar el archivo PDF: " . $rutaPDF);
        }

        // Enviar el correo
        if(!$mail->send()) {
            error_log("Mailer Error: " . $mail->ErrorInfo);
        } else {
            error_log("Mensaje enviado correctamente a: " . $this->email);
        }

    }
    
   
    ////// RENOVACIONES PARA LOS JUGADORES DEL CLUB ///////////////
    public function enviarNotificacionRenovacionAceptada() {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
        $mail->setFrom('cuentas@clubdeportivo.com');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Renovación Aceptada en Club Deportivo';
    
        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';
    
        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong>, tu solicitud de renovación en Club Deportivo ha sido aceptada.</p>";
        $contenido .= "<p>Para más detalles o información, puedes contactarnos.</p>";
        $contenido .= "<p><img src='{$this->rutaLogo}' alt='Logo de la Empresa'></p>"; // Incluir el logo
        $contenido .= '</html>';
        $mail->Body = $contenido;
    
        // Enviar el correo
        if(!$mail->send()) {
            error_log("Mailer Error: " . $mail->ErrorInfo);
        } else {
            error_log("Mensaje enviado correctamente a: " . $this->email);
        }
    }
    
    public function enviarNotificacionRenovacionRechazada() {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
        $mail->setFrom('cuentas@clubdeportivo.com');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Renovación Rechazada en Club Deportivo';
    
        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';
    
        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong>, lamentablemente tu solicitud de renovación en Club Deportivo ha sido rechazada.</p>";
        $contenido .= "<p>Para más detalles o información, puedes contactarnos.</p>";
        $contenido .= "<p><img src='{$this->rutaLogo}' alt='Logo de la Empresa'></p>"; // Incluir el logo
        $contenido .= '</html>';
        $mail->Body = $contenido;
    
        // Enviar el correo
        if(!$mail->send()) {
            error_log("Mailer Error: " . $mail->ErrorInfo);
        } else {
            error_log("Mensaje enviado correctamente a: " . $this->email);
        }
    }
    

}