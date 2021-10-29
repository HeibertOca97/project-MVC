<?php

namespace controllers;

use core\Controller;
use core\Secret;
use models\User;
use core\Logger;

class RegisterController extends Controller
{

    public function index()
    {
        self::isGET();

        $this->view("auth.register");
    }

    public function signup()
    {
        self::isPOST();
        $this->setRequestOldPost();

        if (!$this->input("username")) {
            $this->setErrors("required", "username");
            $this->redirect("register");
        } else if (!$this->input("email")) {
            $this->setErrors("required", "email");
            $this->redirect("register");
        } else if (!$this->input("password")) {
            $this->setErrors("required", "password");
            $this->redirect("register");
        } else {
            try {
                $user = new User();
                $user->set("username", $this->input("username"));
                $user->set("email", $this->input("email"));
                $user->set("password", Secret::bscrypt($this->input("password")));

                if ($user->checkUnique('username', $user->get('username'))) {
                    $this->setErrors("unique", "username");
                    $this->redirect("register");
                } else if ($user->checkUnique('email', $user->get('email'))) {
                    $this->setErrors("unique", "email");
                    $this->redirect("register");
                } else {
                    $this->setRequestOldPost(true);
                    $user->create();
                    $this->creatingAlert("success", "Registro exitoso");
                }
            } catch (\Throwable $th) {
                Logger::error("RegisterController: " . $th);
            }
        }

        $this->redirect("register");
    }
}
