<?php

namespace app\middleware;

use core\Middleware;
use core\Auth;

class AuthMiddleware extends Middleware
{

    public function __construct()
    {
        parent::__construct();
        new Auth(); 
    }

    public function handle($array_actions = [])
    {
        if(in_array($this->method, $array_actions) && !Auth::checkAuth()){
            self::redirect("error"); 
        } 
    }

    public function handleController($controller, $array_actions = []){
        if(strcasecmp($this->controller, $controller) == 0 && in_array($this->method, $array_actions) && Auth::checkAuth()){
            self::redirect("dashboard"); 
        }
    }
}
