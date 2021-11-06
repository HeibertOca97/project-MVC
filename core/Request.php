<?php

namespace core;

use core\HelpView;
use core\App;

class Request extends HelpView
{

    protected function inputFile($filename)
    {
        if (isset($_FILES[$filename])) {
            return $this->json($_FILES[$filename]);
        }
    }

    protected function input($inputName)
    {
        if (isset($_POST[$inputName])) {
            return $this->json($_POST[$inputName]);
        }
    }

    protected static function isPOST()
    {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            header("Location: " . App::config('app.url'));
        }
    }

    protected static function isGET()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            header("Location: " . App::config('app.url'));
        }
    }
}
