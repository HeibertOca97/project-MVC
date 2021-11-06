<?php

namespace app\controllers;

use core\DateTime;
use core\Controller;
use core\Logger;
use core\Secret;
use app\models\User;
use app\mail\ResetMail;

class ResetPasswordController extends Controller
{

    public function index()
    {
        self::isGET();
        $this->view('auth.reset');
    }

    public function checkedResetPassword()
    {
        self::isPOST();
        $this->setRequestOldPost();
        $user = new User();
        if ($this->input('email')) {
            if ($user->checkUnique('email', $this->input('email'))) {
                $this->setRequestOldPost(true);
                $email_verified_at = DateTime::generateAdvanceDateTime('+1 hour');
                try {
                    $u = $user->getUser($this->input('email'));
                    $user->updateUserProperty('email_verified_at', $email_verified_at, $u->email);
                    $this->creatingAlert("success", "¡Hemos enviado su enlace de restablecimiento de contraseña por correo electrónico!");
                    $mail = new ResetMail("mail/resetTemplate", [
                        'url' => $this->config('app.url') . "resetPassword/editNewPassword/" . $u->token_user,
                        'user' => $u->username
                    ]);
                    $mail->to($this->input('email'));
                    $mail->send();
                } catch (\Throwable $th) {
                    $this->creatingAlert("warning", "Ha ocurrido un problema con esta peticion, vuelva a intentar, y si aun no se soluciona comunicar este problema al soporte tecnico.");
                }
            } else {
                $this->creatingAlert("warning", "No podemos encontrar un usuario con esa dirección de correo electrónico.");
            }
        } else {
            $this->setErrors("required", "email");
        }

        $this->redirect('resetPassword');
    }

    public function editNewPassword($tokenEncription)
    {
        self::isGET();

        $user = new User();
        $u = $user->getBy("token_user", $tokenEncription);
        $remenberReset = strtotime($u->email_verified_at);
        $currentDate = strtotime(date("Y-m-d H:i:s"));

        if ($currentDate < $remenberReset) {
            if ($user->checkUnique("token_user", $tokenEncription)) {
                return $this->view('auth.recover', [
                    'email' => $u->email,
                    'token' => $u->token_user
                ]);
            } else {
                $this->creatingAlert("warning", "Acceso denegado");
            }
        } else {
            $this->creatingAlert("warning", "El tiempo para restablecer su contrasena a caducado");
        }
        $this->redirect('login');
    }

    public function updateNewPassword()
    {
        self::isPOST();
        $this->setRequestOldPost();
        $user = new User();
        if ($user->checkUnique('email', $this->input('email')) && $user->checkUnique('token_user', $this->input('token'))) {
            if (!$this->input('password') && !$this->input('confirm_password')) {
                $this->creatingAlert('warning', 'Todo los campos son obligatorio.');
            } else {
                if ($this->input('password') != $this->input('confirm_password')) {
                    $this->creatingAlert('warning', 'La contrasena ingresada no coinciden');
                } else {
                    try {
                        $u = $user->getBy('email', $this->input('email'));
                        $user->updateUserPropertyNull('email_verified_at', $u->email);
                        $user->updateUserProperty('password', Secret::bscrypt($this->input('password')), $u->email);
                        $user->updateToken($u->email);
                        $this->setRequestOldPost(true);
                        $this->redirect('login');
                    } catch (\Throwable $th) {
                        Logger::error("ResetPassword - updateNewPassword: " . $th);
                        $this->redirect('resetPassword/editNewPassword/' . $this->input('token'));
                    }
                }
            }
        } else {
            $this->creatingAlert('warning', 'Credenciales incorrectas.');
        }

        $this->redirect('resetPassword/editNewPassword/' . $this->input('token'));
    }
}
