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

    public function json($result)
    {
        return json_decode(json_encode($result));
    }
}
