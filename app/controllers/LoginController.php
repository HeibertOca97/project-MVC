<?php

namespace app\controllers;

use core\Controller;
use core\Auth;
use core\Logger;
use app\models\User;

class LoginController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->Guest();
    }

    public function index()
    {
        self::isGET();
        $this->view("auth.login");
    }

    public function signin()
    {
        self::isPOST();
        $this->setRequestOldPost();
        $user = new User();
        try {
            if (!$this->input('email') && !$this->input('password')) {
                $this->creatingAlert("warning", "email and password required");
            } else {
                if ($user->confirmUser($this->input('email'), $this->input('password'))) {
                    $userData = $user->getUser($this->input('email'));
                    Auth::setSessionUser($userData);
                    $this->setRequestOldPost(true);
                    $this->redirect('dashboard');
                } else {
                    $this->creatingAlert("warning", "email and/or password incorrectly");
                }
            }
        } catch (\Throwable $th) {
            Logger::error("LoginController: " . $th);
        }

        $this->redirect('login');
    }

    public function logout()
    {
        self::isPOST();
        Auth::logout();
        $this->redirect('login');
    }
}
