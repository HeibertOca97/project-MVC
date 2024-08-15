<?php

namespace app\controllers;

use app\cookie_request\LoginCookie;
use core\Auth;
use core\Controller;
use app\middleware\HTTPRequestMiddleware;
use app\middleware\AuthMiddleware;
use core\help\Logger;
use app\models\User;

class LoginController extends Controller
{
    public function __construct()
    {
        (new HTTPRequestMiddleware(['login']))->handle([
            'GET' => ['index'],
            'POST' => ['signin']
        ]);
        (new AuthMiddleware)->handleController('login', ['index', 'signin']);
    }

    public function index()
    {
        $this->view("auth.login");
    }

    public function signin()
    {
        (new LoginCookie)->toCreateTheEntry('sign_in');
        try {
            $handleError = false;
            $email = $this->input('email'); 
            $password = $this->input('password');
            
            if(!$email){
                $handleError = true;
                $this->setErrorMessage('required', 'email');
            }else if(!$password){
                $handleError = true;
                $this->setErrorMessage('required', 'password');
            }

            if($handleError){
                $this->redirect('login');
            }

            $resultStatus = (new User)->validationSessionCredential($email, $password);
            if (!$resultStatus) {
                $this->setMessageFlash('warning', [
                    "type" => "error",
                    "message" => "Credentials are incorrect"
                ]);
                $this->redirect('login');
            } 

            (new LoginCookie)->toDeleteTheEntry('sign_in');
            $this->redirect('dashboard');
        } catch (\Throwable $err) {
            Logger::error("LoginController: " . $err);
            $this->setMessageFlash('warning', [
                "type" => "error",
                "message" => "Ha ocurrido un problema con su peticion."
            ]);
            $this->redirect('login');
        }
    }

    public function logout(){
        Auth::logout();
        $this->redirect('login');
    }

}
