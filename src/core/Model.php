<?php

namespace Core;

use SafeMySQL;

abstract class Model
{
    protected SafeMySQL $db;
    protected string $tableName;
    protected string $method;
    public array $response;
    public int $status;
    protected array $requestUri;
    protected int|null $id;
    protected \stdClass|null|string|array $data;

    public function __construct($db, $request) {
        $this->db = $db;
        $this->method = $request["method"];
        $this->id = $request["id"];
        $this->data = $request["data"];
    }

    abstract function getResponse(): array;
}
