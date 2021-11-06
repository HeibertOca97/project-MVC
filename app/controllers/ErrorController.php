<?php

namespace app\controllers;

use core\Controller;

class ErrorController extends Controller
{
    public function index()
    {
        $error = "404 | NOT FOUND";
        $this->view('error.error404', [
            'title' => $error,
            'message' => $error
        ]);
    }
}
