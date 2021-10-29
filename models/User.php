<?php

namespace models;

use core\ModelBase;
use core\Secret;

class User extends ModelBase
{
    private $table = "users";

    private $id, $username, $email, $password, $token;

    public function __construct()
    {
        parent::__construct($this->table);
        $this->token = Secret::generateToken();
    }

    public function set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

    public function get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function create()
    {
        $sql = "INSERT INTO {$this->table}(username,email,password,token_user) VALUES('{$this->username}', '{$this->email}', '{$this->password}', '{$this->token}')";

        $this->connection()->query($sql);
    }

    public function confirmUser($email, $password)
    {
        $email = mysqli_real_escape_string($this->connection(), $email);
        $password = mysqli_real_escape_string($this->connection(), $password);

        $sql = "SELECT email, password FROM {$this->table} WHERE email='$email' LIMIT 1";

        $result = $this->connection()->query($sql);

        if ($result->num_rows > 0) {
            $res = $result->fetch_object();

            if (password_verify($password, $res->password)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getUser($email)
    {
        $sql = "SELECT username, email, token_user, created_at, updated_at FROM {$this->table} WHERE email='$email' LIMIT 1";
        $result = $this->connection()->query($sql);

        return $result->fetch_object();
    }

    public function checkUnique($property, $value)
    {
        $sql = "SELECT * FROM {$this->table} WHERE $property='$value' LIMIT 1";

        $result = $this->connection()->query($sql);

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
}
