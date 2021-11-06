<?php

namespace core;

use core\Connection;

class ModelBase extends Connection
{
    private $db;
    private $table;

    public function __construct($table)
    {
        parent::__construct();
        $this->db = $this->getConnection();
        $this->table = $table;
    }

    public function connection()
    {
        return $this->db;
    }

    public function getAll()
    {
        $query = $this->db->query("SELECT * FROM " . $this->table);

        $resultSet = [];

        while ($row = $query->fetch_object()) {
            $resultSet[] = $row;
        }

        return $this->json($resultSet);
    }

    public function getBy($property, $value)
    {
        $result = $this->connection()->query("SELECT * FROM {$this->table} WHERE $property='$value' LIMIT 1");

        return $result->fetch_object();
    }

    public function checkUnique($property, $value)
    {
        $resultSet = $this->db->query("SELECT * FROM {$this->table} WHERE $property='$value' LIMIT 1");

        if ($resultSet->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function json($result)
    {
        return json_decode(json_encode($result));
    }
}
