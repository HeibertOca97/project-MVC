<?php namespace controllers;

use core\Controller;
use models\User;

class HomeController extends Controller{

    public function index(){
        // $u = new User(); // user data - database

        return $this->view('home', [
            'title' => "Home",
            // 'username' => $u->username,
            // 'persons' => $u->personas(),
        ]);
    }

}