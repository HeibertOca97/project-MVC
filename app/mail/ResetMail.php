<?php

namespace app\mail;

use libs\Mailer;
use core\App;
use core\help\ControllerHelp;
use core\RouterView;

class ResetMail extends Mailer
{
    use ControllerHelp, RouterView;

    public function __construct(string $email, string $strView, $data)
    {
        $this->initMailer();
        $this->setSubject("Password Reset - " . App::config('app.name'));
        $this->to($email);
        $detail = [
            "anio" => (date("Y")), 
            "appname" => App::config("app.name"),
            "urlblog" => App::config("app.url") . "blog",
            "logotype" => $this->storage("public/logo192.png"),
        ];
        $data = array_merge($detail, $data); 
        $this->setTemplateMail($this->getHTMLBufferView($strView, $data));
    }

}
