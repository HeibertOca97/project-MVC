<?php

namespace app\mail;

use libs\Mailer;
use core\App;

class ResetMail extends Mailer
{
    public function __construct($strRouteTemplate, $data)
    {
        $this->initMailer();
        $this->setSubject("Password Reset");
        $html = self::templateView($strRouteTemplate, $data);
        $this->setTemplateMail($html);
    }

    private static function templateView($strView, $strData)
    {
        $strView =  str_replace('.', '/', $strView);

        $html = file_get_contents('./resources/' . $strView . '.php');

        $html = str_replace('{{$appname}}', App::config('app.name'), $html);
        $html = str_replace('{{$user}}', $strData['user'], $html);
        $html = str_replace('{{$url}}', $strData['url'], $html);
        $html = str_replace('{{$anio}}', $strData['anio'], $html);

        return $html;
    }
}
