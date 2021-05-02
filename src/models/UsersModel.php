<?php

namespace Models;


use Core\Model;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

class UsersModel extends Model
{
    #[Pure]
    public function __construct($db, $uri)
    {
        parent::__construct($db, $uri);
        $this->tableName = "users";
    }

    #[ArrayShape(["status" => "int", "body" => "array"])]
    function getResponse(): array
    {
        $status = 200;
        $error = false;
        $message = "Ok";
        $data = [];

        if ($this->method === "GET") {
            if ($this->id === null) {
                $data = $this->getAll();
            } else {
                $data = $this->getRow($this->id);
                if ($data === null) {
                    $error = true;
                    $message = "Not found!";
                }
            }
        } elseif ($this->method === "POST") {

        } elseif ($this->method === "PUT") {

        } elseif ($this->method === "DELETE") {

        }




        $body = [
            "error" => $error,
            "message" => $message,
            "data" => $data
        ];

        return [
            "status" => $status,
            "body" => $body
        ];
    }

    protected function getAll(): array
    {
        return $this->db->getAll("SELECT * FROM " . $this->tableName);
    }

    protected function getRow($id): array|null
    {
        return $this->db->getRow("SELECT * FROM " . $this->tableName . " WHERE id=?i", $id);
    }
}
