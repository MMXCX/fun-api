<?php


namespace Core;

use SafeMySQL;

class App
{
    private SafeMySQL $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function run()
    {
        echo "<pre>";
        print_r([$_SERVER["REQUEST_METHOD"],
            file_get_contents("php://input"),
            $_SERVER["REQUEST_URI"]
        ]);
    }
}
