<?php

namespace Models;


use Core\Model;

class UsersModel extends Model
{

    public function __construct($db)
    {
        $this->db = $db;
        $this->tableName = "users";
    }

    function getAll(): array
    {
        return $this->db->getAll("SELECT * FROM users");
    }
}
