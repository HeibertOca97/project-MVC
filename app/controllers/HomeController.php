<?php

namespace app\controllers;

use core\Controller;
use app\middleware\HTTPRequestMiddleware;
 
class HomeController extends Controller
{
    public function __construct()
    {
        (new HTTPRequestMiddleware(['home']))->handle([
            'GET' => ['index'],
        ]);
    }

    public function index()
    {
        $this->view('welcome', [
            'title' => "Welcome to Home",
        ]);
    }
}
