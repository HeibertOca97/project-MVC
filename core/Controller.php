<?php

namespace core;

use core\Request;
use core\Auth;

class Controller extends Request
{
    private $data;

    public function __construct()
    {
        parent::__construct();
        $this->data = [];
        new Auth();
    }

    public function template($view)
    {
        $view = $this->strReplace($view);
        foreach ($this->data as $id_data => $value) {
            ${$id_data} = $value;
        }

        require_once $this->content($view);
    }

    public function view($view, $data = [])
    {
        $view = $this->strReplace($view);
        $this->data = $data;
        foreach ($data as $id_data => $value) {
            ${$id_data} = $value;
        }

        require_once $this->content($view);
    }

    protected function Auth()
    {
        if (!Auth::checkAuth()) {
            $this->redirect('login');
        }
    }

    protected function Guest()
    {
        if (Auth::checkAuth()) {
            $this->redirect('dashboard');
        }
    }

    public function AuthCheck()
    {
        if (Auth::checkAuth()) {
            return true;
        }

        return false;
    }

    public function AuthUser()
    {
        return Auth::user();
    }
}
