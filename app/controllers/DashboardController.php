<?php

namespace app\controllers;

use app\middleware\AuthMiddleware;
use app\middleware\HTTPRequestMiddleware;
use core\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        (new HTTPRequestMiddleware(['dashboard']))->handle([
            'GET' => ['index']
        ]);
        (new AuthMiddleware)->handle(['index']);
    }

    public function index()
    {
        $this->view('dashboard');
    }
}
