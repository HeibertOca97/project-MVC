<?php

namespace core;

use mysqli;
use core\App;

class Connection
{
    private $driver, $host, $user, $pass, $database, $charset;

    public function __construct()
    {
        $this->driver = App::config('database.driver');
        $this->host = App::config('database.host');
        $this->user = App::config('database.user');
        $this->pass = App::config('database.pass');
        $this->database = App::config('database.name');
        $this->charset = App::config('database.charset');
    }

    public function getConnection()
    {
        if ($this->driver == 'mysql' || $this->driver == null) {
            $con = new \mysqli($this->host, $this->user, $this->pass, $this->database);
            $con->set_charset($this->charset);
        }
        return $con;
    }
}
