<?php

namespace app\controllers;

use core\Controller;
use core\Auth;
use app\middleware\UserDataIsComplete;
use app\models\User;

class CompleteDataController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->Auth();
        UserDataIsComplete::handle();
    }

    public function index()
    {
        self::isGET();
        $this->view('auth.complete');
    }

    public function updateInfo()
    {
        self::isPOST();
        $this->setRequestOldPost();
        if (!$this->input('username')) {
            $this->creatingAlert('warning', 'Todo los campos son obligaorios');
        } else {
            $user = new User();
            if ($user->checkUnique('username', $this->input('username'))) {
                $this->setErrors("unique", "username");
            } else {
                $user->updateUserProperty('username', $this->input('username'), Auth::user()->email);
                $userData = $user->getUser(Auth::user()->email);
                Auth::setSessionUser($userData);
                $this->setRequestOldPost(true);
            }
        }

        return $this->redirect('completeData');
    }
}
