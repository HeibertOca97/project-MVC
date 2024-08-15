<?php

namespace libs;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use core\App;

class Mailer
{
    private $mail;
    private $email, $host, $userEmail, $userPass, $port, $appname;
    private $fromEmail, $fromName;
    private $html, $subject;
    protected static $template_path = "./resources/views/";

    public function initMailer()
    {
        $this->mail = new PHPMailer(true);

        $this->host = App::config('mail.m_host');
        $this->userEmail = App::config('mail.m_username');
        $this->userPass = App::config('mail.m_password');
        $this->port = App::config('mail.m_port');
        $this->appname = App::config('app.name');
    }

    public function from($email, $name)
    {
        $this->fromEmail = $email;
        $this->fromName = $name;
    }

    public function to($email)
    {
        $this->email = $email;
    }

    public function setTemplateMail($strHtml)
    {
        $this->html = $strHtml;
    }

    public function getTemplateMail()
    {
        return $this->html;
    }

    public function setSubject($strSubject)
    {
        $this->subject = $strSubject;
    }

    /*******
     * Retorna un Array con valores de "TRUE" o "FALSE"con sus respectivos mensajes. 
     *********/

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

            $emailFrom = $this->fromEmail == null ? $this->userEmail : $this->fromEmail;
            $nameFrom = $this->fromName == null ? $this->appname : $this->fromName;
            //Recipients
            if(is_array($this->email)){
                for($i = 0; $i < count($this->email); $i++){
                    $this->mail->addAddress($this->email[$i]); //Add a recipient
                }
            }else{
                $this->mail->addAddress($this->email); //Add a recipient
            }
            $this->mail->setFrom($emailFrom, $nameFrom);

            //Content
            $this->mail->isHTML(true); //Set email format to HTML
            $this->mail->CharSet = 'UTF-8';
            $this->mail->Subject = $this->subject;
            $this->mail->Body = $this->getTemplateMail();

            $this->mail->send();
            //$intentos=1; 
            //while((!$exito)&&($intentos<5)&&($this->mail->ErrorInfo!="SMTP Error: Data not accepted")){
                //sleep(5);
                //$exito = $this->mail->Send();
                //$intentos=$intentos+1;                
            //}
            return json_decode(json_encode(array(
                "message" => 'Mensaje enviado correctamente',
                "success" => true,
            )));
        } catch (Exception $e) {
            return json_decode(json_encode(array(
                "message" => "{$this->mail->ErrorInfo}",
                "success" => false,
            )));
        }
    }
}
