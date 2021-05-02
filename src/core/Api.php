<?php


namespace Core;

use SafeMySQL;

class Api
{
    private SafeMySQL $db;
    private array $requestUri;
    private array $routes;

    public function __construct($db)
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: *");
        header("Access-Control-Allow-Credentials: true");
        header("Access-Control-Allow-Headers: *");
        header("Content-Type: application/json");
        session_start();

        $this->db = $db;
        $this->requestUri = explode("/", trim($_SERVER["REQUEST_URI"], "/"));
        $this->routes = require_once("../src/settings/routes.php");
    }

    public function run(): void
    {
        if (in_array($this->requestUri[0], $this->routes)) {
            $path = "\Models\\" . ucfirst($this->requestUri[0]) . "Model";

            $method = $_SERVER["REQUEST_METHOD"];
            $id = isset($this->requestUri[1]) ? (int)$this->requestUri[1] : null;
            $data = json_decode(file_get_contents("php://input"));

            if ($method === "GET") $data = $_GET;

            $request = [
                "method" => $method,
                "id" => $id,
                "data" => $data
            ];

            $model = new $path($this->db, $request);
            $response = $model->getResponse();

            echo $this->response($response["body"], $response["status"]);
        } else {
            echo $this->response(["error" => true, "message" => "Not found"], 200);
        }
    }

    protected function response($data, $status = 200): bool|string
    {
        header("HTTP/1.1 " . $status . " " . $this->requestStatus($status));
        return json_encode($data);
    }

    private function requestStatus($code): string
    {
        $status = array(
            200 => "OK",
            201 => "Created",
            202 => "Accepted",
        );
        return ($status[$code]) ?: $status[200];
    }
}
