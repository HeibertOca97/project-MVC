<?php

namespace app\controllers;

use app\cookie_request\LoginCookie;
use app\exceptions\DatabaseException;
use core\Controller;
use app\models\User;

class RegisterController extends Controller
{
    public function index()
    {
        $this->view("auth.register");
    }

    public function signup()
    {
        (new LoginCookie)->toCreateTheEntry('sign_up');
        $handleError = false;
        $email = $this->input("email");
        $password = $this->input("password");
        $password_2 = $this->input("confirm_password");

        if (!$email) {
            $handleError = true;
            $this->setErrorMessage("required", "email");
        } else if (!$password) {
            $handleError = true;
            $this->setErrorMessage("required", "password");
        } else if (!$password_2) {
            $handleError = true;
            $this->setErrorMessage("required", "confirm_password");
        } else if($password != $password_2){
            $handleError = true;
            $this->setMessageFlash("warning", [
                "type" => "error",
                "message" => "The password confirmation does not match.",
            ]);
        } 

        if($handleError){
            $handleError = false;
            $this->redirect('register');
        }

        try {
            $user = new User();
            if(!$user->checkUniqueEmail($email)){
                $this->setErrorMessage("unique", "email");
                $this->redirect('register');
            }
            
            $status_result = $user->create([
                "email"=> $email,
                "password"=> $password,
            ]);
    
            if(!$status_result){
                $this->setMessageFlash('warning', array(
                    "type" => "error",
                    "message" => "An error occurred while creating the user account."
                ));    
            }else{
                $this->setMessageFlash('success', array(
                    "type" => "success",
                    "message" => "User account successfully created!"
                ));
            }

            (new LoginCookie)->toDeleteTheEntry('sign_up');
        } catch (DatabaseException $ex) {
            $this->setMessageFlash('warning', array(
                "type" => "error",
                "message" => $ex->getMessage()
            ));
        }
        $this->redirect('register');
    }
}
