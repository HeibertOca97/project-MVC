<?php

namespace core;

use core\Connection;
use core\help\DateTime;
use core\help\Logger;
use core\help\Secret;

class ModelPDO extends Connection
{

    use DateTime, Logger, Secret;

    private $db;
    private $table;

    public function __construct($table)
    {
        parent::__construct();
        $this->table = $table;
        $this->db = $this->getConnection();
    }

    public function connection()
    {
        return $this->db;
    }

    public function getLastInsertId(){
        return $this->db->lastInsertId();
    }

    public static function getSlug(string $str_value): string{
        $str_value = trim($str_value, " ");
        $str_value = str_replace(" ", "-", str_replace('?', '', str_replace('¿', '', $str_value)));
        return strtolower($str_value);
    }

    public function getTotal()
    {
        try {
            $result = $this->db->prepare("SELECT * FROM {$this->table}");
            $result->execute();
            return $result->rowCount();
        } catch (\PDOException $ex) {
            throw new \PDOException("Failed on the line: " . $ex->getLine() . ' | Message: ' . $ex->getMessage());
        }
    }

    public function getAll()
    {
        try {
            $result = $this->db->prepare("SELECT * FROM {$this->table} ORDER BY id DESC");
            if($result->execute()){
                return $result->fetchAll(\PDO::FETCH_OBJ);
            }
        } catch (\PDOException $ex) {
            throw new \PDOException("Failed on the line: " . $ex->getLine() . ' | Message: ' . $ex->getMessage());
        }
    }

    public function getAllBy($property, $value)
    {
        try {
            $result = $this->db->prepare("SELECT * FROM {$this->table} WHERE $property = ?");

            if ($result->execute([$value])) {
                return $result->fetchAll(\PDO::FETCH_OBJ);
            }

        } catch (\PDOException $ex) {
            throw new \PDOException("Failed on the line: " . $ex->getLine() . ' | Message: ' . $ex->getMessage());
        }
    }

    public function getBy($property, $value)
    {
        try {
            $result = $this->db->prepare("SELECT * FROM {$this->table} WHERE $property=? LIMIT 1");

            if ($result->execute([$value])) {
                return $result->fetch(\PDO::FETCH_OBJ);
            }

        } catch (\PDOException $ex) {
            throw new \PDOException("Failed on the line: " . $ex->getLine() . ' | Message: ' . $ex->getMessage());
        }
    }

    public function checkColumn($property, $value)
    {
        try {
            $sentence = $this->db->prepare("SELECT * FROM {$this->table} WHERE $property=? LIMIT 1");
            $sentence->execute([$value]);
            if ($sentence->rowCount() > 0) return true;
            return false;
        } catch (\PDOException $ex) {
            throw new \PDOException("Failed on the line: " . $ex->getLine() . ' | Message: ' . $ex->getMessage());
        }
    }

    public function json($result)
    {
        return json_decode(json_encode($result));
    }

    public static function getTotalPages($limit, $numRow)
    {
        $pages = ceil($numRow / $limit);
        return $pages;
    }

    public function deleteBy($column, $value)
    {
        try {
            $result = $this->db->prepare("DELETE FROM {$this->table} WHERE $column=?");
            if ($result->execute([$value])) {
                return true;
            }
            return false;
        } catch (\PDOException $ex) {
            throw new \PDOException("Failed on the line: " . $ex->getLine() . ' | Message: ' . $ex->getMessage());
        }
    }

    public function deleteByStringId(string $string_id){
        try{
            $sentence = $this->connection()->prepare("DELETE FROM {$this->table} WHERE id IN ($string_id)");
            $sentence->execute();
        }catch(\PDOException $ex){
            throw new \PDOException('Fallo SQL: Ha ocurrido un problema al realizar esta peticion');
        }
    }
}
