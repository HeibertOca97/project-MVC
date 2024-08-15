<?php

namespace app\controllers;

use core\Controller;
use app\middleware\HTTPRequestMiddleware;
use app\middleware\AuthMiddleware;
use core\Auth;

class AuthController extends Controller{

    public function __construct() {
        (new HTTPRequestMiddleware(['auth']))->handle([
            'GET' => ['logout']
        ]);
        (new AuthMiddleware)->handle(['logout']);
    }

    public function logout()
    {
        Auth::logout();
        $this->redirect('login');
    }

}
