<?php

namespace app\models;

use core\ModelPDO;
use core\Auth;
use core\help\Logger;
use core\help\Secret;
use app\exceptions\DatabaseException;

class User extends ModelPDO
{

    private $table = "users";

    private $email, $password, $token;

    public function __construct()
    {
        parent::__construct($this->table);
        $this->token = str_replace("/", ".", self::generateToken());
    }

    public function __invoke($data){
        $this->email = $data["email"];
        $this->password = $data["password"];
    }

    /******************************
        GETTER AND SETTER
     **********************************/

    public function set(string $property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

    public function get(string $property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }
    /*********************************/

    public function updateToken(string $email)
    {
        try{
            $query = $this->connection()->prepare("UPDATE {$this->table} SET token_user='{$this->token}' WHERE email=? ");
            if ($query->execute([$email])) return true;
            return false;
        }catch(\PDOException $ex){
            Logger::error("Failed on the line: " . $ex->getLine() . ' | PDOMessage: ' . $ex->getMessage());
            throw new DatabaseException("An error occurred while updating the token.");
        }catch(\Exception $ex){
            Logger::error("Failed on the line: " . $ex->getLine() . ' | Message: ' . $ex->getMessage());
        }
    }

    public function getUser(string $uc)
    {
        try{
            $query = $this->connection()->prepare("SELECT * FROM {$this->table} WHERE email = :email LIMIT 1");
            $query->bindParam(':email', $uc, \PDO::PARAM_STR);
            if($query->execute()) return $query->fetch(\PDO::FETCH_OBJ);
        }catch(\PDOException $ex){
            Logger::error("Failed on the line: " . $ex->getLine() . ' | PDOMessage: ' . $ex->getMessage());
            throw new DatabaseException("An error occurred while obtaining user data.");
        }
    }

    public function checkUniqueEmail(string $email): bool{
        try {
            $query = $this->connection()->prepare("SELECT email FROM {$this->table} WHERE email = :e");
            $query->bindParam(':e', $email, \PDO::PARAM_STR);
            $query->execute();
            if($query->rowCount() > 1) return false;
            return true;
        } catch (\PDOException $ex) {
            Logger::error("Failed on the line: " . $ex->getLine() . ' | PDOMessage: ' . $ex->getMessage());
            throw new DatabaseException("A problem has occurred with data verification.");
        }
    }

    public function checkAccessUser(string $email, string $password)
    {
        try{
            $query = $this->connection()->prepare("SELECT password FROM {$this->table} WHERE email = :email LIMIT 1");
            $query->bindParam(':email', $email, \PDO::PARAM_STR);
            
            if ($query->execute()) {
                $response = $query->fetch(\PDO::FETCH_OBJ);
                if ($response != null && password_verify($password, $response->password)) return true;
            }
            return false;
        }catch(\PDOException $ex){
            Logger::error("Failed on the line: " . $ex->getLine() . ' | PDOMessage: ' . $ex->getMessage());
            throw new DatabaseException("A occured a problem with verification of user");
        }
    }


    public function validationSessionCredential(string $email, string $password)
    {
        if(!$this->checkAccessUser($email, $password)) return false;

        $getData = $this->getUser($email);
        Auth::setSessionUser($getData);
        return true;
    }

    public function create(array $data){
        try {
            $pass_hash = Secret::bscrypt($data["password"]);
            $query = $this->connection()->prepare("INSERT INTO {$this->table} (email, password, token) VALUES (:e, :p, :t)");
            $query->bindParam(":e", $data["email"], \PDO::PARAM_STR);
            $query->bindParam(":p", $pass_hash, \PDO::PARAM_STR);
            $query->bindParam(":t", $this->token, \PDO::PARAM_STR);
            if($query->execute()) return true;
            return false;
        } catch (\PDOException $ex) {
            Logger::error("Failed on the line: " . $ex->getLine() . ' | PDOMessage: ' . $ex->getMessage());
            throw new DatabaseException("A problem has occurred with the creation of the user account");
        }
    }

    
}
