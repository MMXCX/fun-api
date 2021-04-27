<?php

namespace Core;

use SafeMySQL;

abstract class Model
{
    protected SafeMySQL $db;
    protected string $tableName;


    abstract function getAll();
}
