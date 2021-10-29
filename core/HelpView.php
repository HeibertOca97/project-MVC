<?php

namespace core;

use core\App;
use core\HelpRoute;

class HelpView extends HelpRoute
{
    private $path;

    public function assets($dir)
    {
        $strPathUrl = App::config('app.url') . "public/" . $dir;
        print $strPathUrl;
    }

    public function route($dir)
    {
        $strPathUrl = App::config('app.url') . $dir;
        print $strPathUrl;
    }

    public function url($dir)
    {
        $strPathUrl = App::config('app.url') . $dir;
        return $strPathUrl;
    }

    public function storage($dir)
    {
        $strPathUrl = App::config('app.url') . $dir;
        print $strPathUrl;
    }

    protected function content($dir)
    {
        $strPathUrl = PATH . "resources/" . $dir . ".php";
        return $strPathUrl;
    }

    protected function strReplace($str)
    {
        $strRoute =  str_replace('.', '/', $str);
        return $strRoute;
    }

    public function config($strToValue)
    {
        return App::config($strToValue);
    }

    protected function json($array)
    {
        return json_decode(json_encode($array));
    }

    // METHOD FILE
    protected function setStorage($directory = null, $filename)
    {
        $this->path = "public/storage/" . $directory;
        return $this->path . "/" . $filename;
    }

    protected function uploadFile($tmp_name, $route_file)
    {
        if (!file_exists($this->path)) {
            mkdir($this->path, 0777, true);
        }

        move_uploaded_file($tmp_name, $route_file);
    }

    protected function deleteFile($path)
    {
        unlink($path);
    }

    // METHOD ERRORS
    protected function setErrors($type, $nameInput)
    {
        $ruleArray = [
            "required" => "Campo $nameInput obligatorio.",
            "unique" => "Ya existe un usuario con este dato."
        ];

        setcookie("error_$nameInput", $ruleArray[$type], strtotime('3 second'));
    }

    public function getError($nameInput)
    {
        if ($_COOKIE["error_$nameInput"]) {
            return $_COOKIE["error_$nameInput"];
        }
    }

    //RECOVERY VALUE OLD
    /************
     * Guarda en cache "Cookie" el valor de los * inputs del formulario. 
     * Recibe un valor "boolean"
     * Por defecto recibe un "FALSE" que creara una cookie con ese valor.
     * Cuando recibe un "TRUE" Limpiara el valor de esa cookie
     ************/
    protected function setRequestOldPost($bool = false)
    {
        if ($bool) {
            foreach ($_POST as $key => $value) {
                // setcookie($key, "", strtotime('3 second'));
                setcookie($key, "", time() - 60);
            }
        } else {
            foreach ($_POST as $key => $value) {
                setcookie($key, $value, strtotime('3 second'));
            }
        }
    }

    /************
     * Retorna el valor de una cookie, que fue creada por la funcion @"setRequestOldPost"
     * Esta funcion ayudara a recupera lo que se haya ingresado en los campo de un formulario
     ************/

    public function old($name, $value = null)
    {
        if ($value != null) {
            return $value;
        } else {
            if ($_COOKIE["$name"]) {
                return $_COOKIE["$name"];
            }
        }
    }

    /*****
    MESSAGE - ALERTS
     *******/
    protected function creatingAlert($name, $message)
    {
        setcookie($name, $message, strtotime('3 second'));
    }

    public function getStateAlert($name)
    {
        if ($_COOKIE["$name"]) {
            return true;
        }

        return false;
    }

    public function getMessageAlert($name)
    {
        if ($_COOKIE["$name"]) {
            return $_COOKIE["$name"];
        }
    }
}
