<?php

namespace app\controllers;

use core\Controller;
use core\Secret;
use core\Logger;
use app\models\User;

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
        } else if (!$this->input("email")) {
            $this->setErrors("required", "email");
        } else if (!$this->input("password")) {
            $this->setErrors("required", "password");
        } else if (!$this->input("confirm_password")) {
            $this->setErrors("required", "confirm_password");
        } else {
            if ($this->input("password") != $this->input("confirm_password")) {
                $this->creatingAlert('warning', "La contrasena ingresada no coinciden");
            } else {
                try {
                    $user = new User();
                    $user->set("username", $this->input("username"));
                    $user->set("email", $this->input("email"));
                    $user->set("password", Secret::bscrypt($this->input("password")));

                    if ($user->checkUnique('username', $user->get('username'))) {
                        $this->setErrors("unique", "username");
                    } else if ($user->checkUnique('email', $user->get('email'))) {
                        $this->setErrors("unique", "email");
                    } else {
                        $this->setRequestOldPost(true);
                        $user->create();
                        $this->creatingAlert("success", "Inscripcion exitosa");
                    }
                } catch (\Throwable $th) {
                    Logger::error("RegisterController: " . $th);
                }
            }
        }

        $this->redirect("register");
    }
}
