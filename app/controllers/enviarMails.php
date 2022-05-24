<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';

class enviarEmail
{
    var $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
    }

    /**
     * Función que envía la información diligenciada en el panel de asignación
     * @param type $datos
     * @return type $boolean resultado
     */
    /*public function enviarSoporte($datos)
    {
        try {
            session_start();
            
            //Server settings
            $this->mail->SMTPDebug = 0;                      // Enable verbose debug output
            $this->mail->isSMTP();                                            // Send using SMTP
            $this->mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $this->mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $this->mail->Username   = 'entornossoluciones@gmail.com';                     // SMTP username
            $this->mail->Password   = 'Entornos12345';                               // SMTP password
            $this->mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $this->mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $this->mail->setFrom('entornossoluciones@gmail.com', 'Cristian');
            $this->mail->addAddress('entornossoluciones@gmail.com', 'Camilo');
            //$this->mail->addAddress('dev@fianzaltda.com', 'Camilo');
            //$this->mail->addAddress('odbg2013@gmail.com', 'Oscar');
            // Add a recipient
            // $mail->addAddress('ellen@example.com');               // Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            // Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $this->mail->isHTML(true);                                  // Set email format to HTML
            $this->mail->Subject = $datos['errores_soporte'];
            $this->mail->Body    = 'El <b>' . $_SESSION['acceso'][0]['nombre_rol'] . '</b>: ' . $_SESSION['nombre'] . 
                                   '<br><b>Con extención:</b> ' . $datos['extencion'].
                                   '<br><b>Id cartera:</b> '. $_SESSION['carteraActual'].
                                   '<br><b>Detalle:</b> '. $datos['detalle'];
            $this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $this->mail->send();
            $resultado = "ok";
        } catch (Exception $e) {
            $resultado = "Mensaje no enviado: {$this->mail->ErrorInfo}";
        }
        return $resultado;
    }*/
}
