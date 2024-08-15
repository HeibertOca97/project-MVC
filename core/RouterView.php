<?php

namespace core;

use core\App;

trait RouterView
{
    private $path;

    public static function redirect($url = null)
    {
        header("Location: " . App::config('app.url') . $url);
        die();
    }

    public function assets($dir)
    {
        $strPathUrl = App::config('app.url') . "public/" . $dir;
        print $strPathUrl;
    }

    public function route($dir)
    {
        $strPathUrl = App::config('app.url') . $dir;
        return $strPathUrl;
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

    protected static function content($dir)
    {
        $strPathUrl = PATH . "resources/views/" . $dir . ".php";
        return $strPathUrl;
    }

    protected static function strReplace($str)
    {
        $strRoute =  str_replace('.', '/', $str);
        return $strRoute;
    }

    public function config($strToValue)
    {
        return App::config($strToValue);
    }

    protected static function json($array)
    {
        return json_encode($array);
    }
    
    protected static function jsonDecode($array)
    {
        return json_decode(json_encode($array));
    }
    
    // METHOD FILE
    protected function setStorage($directory = null, $filename = null)
    {
        $this->path = "public/storage/" . $directory;
        return $this->path . "/" . $filename;
    }

    protected function uploadFile($tmp_name, $route_file)
    {
        if (!file_exists($this->path)) {
            mkdir($this->path, 0777, true);
        }

        if (move_uploaded_file($tmp_name, $route_file)) {
            return true;
        }

        return false;
    }

    protected function deleteFile($path)
    {
        unlink($path);
    }

    /*****
        CREATOR OF TEMPORARY "ERROR" MESSAGES
        Only receive required | unique
     *******/
    protected function setErrorMessage($type, $nameInput)
    {
        $ruleArray = [
            "required" => "Campo $nameInput obligatorio.",
            "unique" => "Ya existe un usuario con este dato."
        ];

        $arrayOptions = [
            "type" => "error",
            "message" => $ruleArray[$type]
        ];

        setcookie("error_$nameInput", json_encode($arrayOptions), strtotime('+5 seconds'), '/', null);
    }

    public function getErrorMessage($nameInput)
    {
        $nameInput = "error_" . $nameInput;

        if (isset($_COOKIE[$nameInput])) {
            $response = json_decode($_COOKIE[$nameInput]);
            return "<div class='alerts alert-{$response->type}'><small>{$response->message}</small></div>";
        }
    }

    public function checkStateError($nameInput)
    {
        $nameInput = "error_" . $nameInput;
        if (isset($_COOKIE[$nameInput])) return true;
        return false;
    }

    /*************
        CREATE OLD INPUT VALUES FROM THE FORM

     * Guarda en cache "Cookie" el valor de los * inputs del formulario.
     * Recibe un valor "boolean"
     * Por defecto recibe un "FALSE" que creara una cookie con ese valor.
     * Cuando recibe un "TRUE" Limpiara el valor de esa cookie
     ************/
    protected function setRequestOldInput($bool = false, $arrayInput)
    {
        if ($bool) {
            foreach ($arrayInput as $key => $value) {
                setcookie($key, "", strtotime('-3 seconds'), '/', null);
            }
        } else {
            foreach ($arrayInput as $key => $value) {
                setcookie($key, $value, strtotime('+3 seconds'), '/', NULL);
            }
        }
    }

    /************
        RETRIEVE OLD INPUT VALUES FROM THE FORM

     * Retorna el valor de una cookie, que fue creada por la funcion @"setRequestOldInput"
     * Esta funcion ayudara a recupera lo que se haya ingresado en los campo de un formulario
     ************/
    public function old($nameInput, $value = null)
    {
        if ($value != null) {
            return $value;
        } else {
            if (isset($_COOKIE[$nameInput])) {
                return $_COOKIE[$nameInput];
            }
        }
    }

    /*****
        CREATOR OF TEMPORARY "FLASH" MESSAGES
        array $options = [$type: error|success, $message: string]
     *******/
    public function setMessageFlash(string $name, array $options)
    {
        setcookie($name, json_encode($options), strtotime('+5 seconds'), '/', NULL);
    }

    public function getMessageFlash(string $name)
    {
        if (isset($_COOKIE[$name])) {
            $response = json_decode($_COOKIE[$name]);
            return "<div class='alerts alert-{$response->type}'><small>{$response->message}</small></div>";
        }
        return null;
    }

    public function checkMessageFlash($name)
    {
        if (isset($_COOKIE[$name])) return true;
        return false;
    }
}
