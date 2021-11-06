<?php

namespace app\controllers;

use core\Controller;

class HomeController extends Controller
{

    public function index()
    {
        self::isGET();

        $this->view('welcome', [
            'title' => "Welcome to Home",
        ]);
    }
}
