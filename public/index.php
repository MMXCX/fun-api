<?php


use Core\App;

require_once("../vendor/autoload.php");

$param = require_once("../src/settings/db.php");

$db = new SafeMySQL($param);

$app = new App($db);

$app->run();



