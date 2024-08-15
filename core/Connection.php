<?php

namespace core;

use core\App;
use core\help\Logger;

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
        if ($this->driver == 'mysqli' || $this->driver == null) {
            return $this->getMySQL();
        }

        if ($this->driver == 'pdo') {
            return $this->getPDO();
        }
    }

    public function getMySQL(): \mysqli
    {
        try {
            $con = new \mysqli($this->host, $this->user, $this->pass, $this->database);
            $con->set_charset($this->charset);
        } catch (\Exception $err) {
            Logger::error("Database connection failure: " . $err->getMessage());
            throw new \Exception("Database connection failure");
        }

        return $con;
    }

    private function getPDO(): \pdo
    {
        $pdo = null;
        $stringConect = "mysql:host={$this->host};dbname={$this->database};charset={$this->charset};";
        $options = array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES {$this->charset}",
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES => false,
        );
        try {
            $pdo = new \PDO($stringConect, $this->user, $this->pass, $options);
        } catch (\PDOException $err) {
            Logger::error("Database connection failure: " . $err->getMessage());
            throw new \PDOException("Database connection failure");
        }

        return $pdo;
    }
}
