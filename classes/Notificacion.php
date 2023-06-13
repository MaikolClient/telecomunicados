<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Notificacion
{
    public $nombre;
    public $anexo;


    public function __construct($nombre, $anexo)
    {
        $this->nombre = $nombre;
        $this->anexo = $anexo;
    }

    public function enviarNotificacion()
    {

        // crear nuevo correo
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('no-reply@telecomunicados.cl');
        $mail->addAddress('di.hermosilla@duocuc.cl', 'Diego Hermosilla');
        $mail->Subject = 'Anexo Eliminado';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p>El usuario <strong>" . $this->nombre . "</strong> ha eliminado un anexo.</p>";
        $contenido .= "<p>El anexo eliminado es: <strong>" . $this->anexo . "</strong></p>";
        $contenido .= "<p>Fecha y hora de eliminación: " . date('d-m-Y H:i:s') . "</p>";
        $contenido .= '</html>';

        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();
    }
}