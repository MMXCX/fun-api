<?php


namespace Models;


use JetBrains\PhpStorm\ArrayShape;
use Respect\Validation\Validator as v;

class AuthModel extends \Core\Model
{

    #[ArrayShape(["status" => "int", "body" => "array"])]
    function getResponse(): array
    {
        $status = 200;
        $error = true;
        $message = "Not found";
        $data = [];

        if ($this->method === "POST") {
            if (isset($this->data->action) && $this->data->action === "create") {
                return $this->regUser($this->data);
            }
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

    #[ArrayShape(["status" => "int", "body" => "array"])]
    function regUser($data): array
    {
        if (isset($data->email)
            && v::email()->validate($data->email)
            && isset($data->password)
            && v::stringType()->length(8, 32)->validate($data->password)) {
            die("OK");
        }


        return [
            "status" => 201,
            "body" => [
                "error" => false,
                "message" => "Cuccess! User created.",
            ]
        ];
    }
}
