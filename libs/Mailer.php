<?php

namespace libs;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    private $mail, $email, $host, $userEmail, $userPass, $port;
    public $subject;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);

        $m = include './config/app.php';
        $this->host = $m['MAIL']['M_HOST'];
        $this->userEmail = $m['MAIL']['M_USERNAME'];
        $this->userPass = $m['MAIL']['M_PASSWORD'];
        $this->port = $m['MAIL']['M_PORT'];
    }

    public function to($emailUser)
    {
        $this->email = $emailUser;
    }

    public function send()
    {
        try {
            //Server settings
            $this->mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER; //Enable verbose debug output
            $this->mail->isSMTP(); //Send using SMTP
            $this->mail->Host       = $this->host; //Set the SMTP server to send through
            $this->mail->SMTPAuth   = true; //Enable SMTP authentication
            $this->mail->Username   = $this->userEmail; //SMTP username
            $this->mail->Password   = $this->userPass; //SMTP password
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
            $this->mail->Port = $this->port; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $this->mail->setFrom($this->userEmail, 'MVC');
            $this->mail->addAddress($this->email); //Add a recipient

            //Content
            $this->mail->isHTML(true); //Set email format to HTML
            $this->mail->Subject = 'Here is the subject';
            $this->mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $this->mail->send();

            return array(
                "message" => 'Mensaje enviado correctamente',
                "success" => true
            );
        } catch (Exception $e) {
            return array(
                "message" => "Error al enviar el mensaje. Mailer Error: {$this->mail->ErrorInfo}",
                "success" => false
            );
        }
    }
}
