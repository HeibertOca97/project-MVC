<?php

namespace core;

use core\Request;
use core\Auth;
use core\help\CheckRoute;
use core\help\ControllerHelp;

class Controller extends Request
{
    use CheckRoute, ControllerHelp;

    private $data = [];

    public function __construct()
    {
        new Auth();
    }
    
    public function AuthCheck()
    {
        if (Auth::checkAuth()) return true;
        return false;
    }

    public function AuthUser()
    {
        return Auth::user();
    }

    public function getSessionValue($session_name, $property_name){
        return Auth::getSession($session_name)[$property_name];
    }

    public function error()
    {
        $error = "404 | This page could not be found.";
        $this->view('error.error', [
            'title' => $error,
            'message' => $error
        ]);
    }
}
