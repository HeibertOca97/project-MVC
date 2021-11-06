<?php

namespace app\controllers;

use core\Controller;
use app\middleware\UserDataIsNotComplete;

class DashboardController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->Auth();
        UserDataIsNotComplete::handle();
    }

    public function index()
    {
        $this->view('views.dashboard');
    }
}
