<?php

use Core\Api;

require_once("../src/settings/global.php");
require_once("../vendor/autoload.php");

$param = require_once("../src/settings/db.php");

$db = new SafeMySQL($param);

$api = new Api($db);

$api->run();



