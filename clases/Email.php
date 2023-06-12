<?php

namespace Clases;
use PHPMailer\PHPMailer\PHPMailer;

class Email{
    public $email;
    public $nombre;
    public $apellido;
    public $token;

    public function __construct ($email, $nombre, $apellido, $token){
        $this->email = $email;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->token = $token;
    }

    //Enviar confirmación de correo
    public function enviarConfirmacion(){
        //creamos la instancia
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host='sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = '92e6672e04db42';
        $mail->Password = '05b691d1ee51ef';
        $mail->MAIL_ENCRYPTION = 'tls';
        $mail->Port = 2525;

        //Recipients o destinatarios
        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'appsalon.com');
        $mail->Subject = 'Confirma tu cuenta';

        //Content HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $content = "<html>";
        $content .= "<p><strong>Hola " . $this->nombre . " " . $this->apellido;
        $content .= " </strong> Has creado una cuenta en appSalon, ";
        $content .= "solo debes confirmarla en el siguiente enlace</P>";
        $content .= "<p>Presiona aquí: <a href='charriacitas.domcloud.io?token="
         . $this->token . "' >Confirmar Cuenta</a></p>";
        $content .= "<p>Si no solicitaste el cambio, puedes ignorar el mensaje </p>";
        $content .= "</HTML";
        
        $mail->Body = $content;

        $mail->send();
    }

    public function enviarInstrucciones(){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host='sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = '92e6672e04db42';
        $mail->Password = '05b691d1ee51ef';
        $mail->MAIL_ENCRYPTION = 'tls';
        $mail->Port = 2525;

        //Recipients o destinatarios
        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'appsalon.com');
        $mail->Subject = 'Reestablece tu password';

        //Content HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $content = "<html>";
        $content .= "<p><strong>Hola " . $this->nombre . " " . $this->apellido;
        $content .= " </strong> Has solicitado reestablecer tu password en appSalon, ";
        $content .= "sigue el siguiente enlace</P>";
        $content .= "<p>Presiona aquí: <a href='http://localhost:3000/recover?token="
         . $this->token . "' >Confirmar Cuenta</a></p>";
        $content .= "<p>Si no solicitaste el cambio, puedes ignorar el mensaje </p>";
        $content .= "</HTML";
        
        $mail->Body = $content;

        $mail->send();
    }
}
