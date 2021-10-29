<?php

namespace controllers;

use core\Controller;
use core\Auth;
use mail\TestMail;
use core\Logger;

class DashboardController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->Auth();
    }

    public function index()
    {
        $this->view('views.dashboard');
    }

    public function sendmail()
    {
        $dataReq = [
            'subject' => 'Asunto del mensaje',
            'message' => "Mensaje del usuario enviado desde algun formulario",
            'anio' => 2021
        ];
        $m = new TestMail("mail.test", $dataReq);

        $m->to('heibertvts1997@gmail.com');
        $res = $m->send();

        if ($res['success'] == true) {
            $res['message'];
        } else {
            Logger::error($res['message']);
        }

        $this->redirect('dashboard');
    }
}
