<?php

namespace mail;

use libs\Mailer;
use core\App;

class TestMail extends Mailer
{
    public function __construct($strRouteTemplate, $data)
    {
        $this->initMailer();
        $this->setSubject("Asunto de la notificacion del mail : TestMail");
        $html = self::templateView($strRouteTemplate, $data);
        $this->setTemplateMail($html);
    }

    private static function templateView($strView, $strData)
    {
        $strView =  str_replace('.', '/', $strView);

        $html = file_get_contents('./resources/' . $strView . '.php');

        $html = str_replace('{{$appname}}', App::config('app.name'), $html);
        $html = str_replace('{{$subject}}', $strData['subject'], $html);
        $html = str_replace('{{$message}}', $strData['message'], $html);
        $html = str_replace('{{$anio}}', $strData['anio'], $html);

        return $html;
    }
}
