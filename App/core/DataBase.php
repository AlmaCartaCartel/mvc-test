<?php


namespace core;

use mysqli;

class DataBase
{
    static function db_connect()
    {
        $db = new \PDO("mysql:host=".HOST.";dbname=".DB_NAME, LOGIN, PASSWORD );

        if (mysqli_connect_errno()) {
            printf("Не удалось подключиться: %s\n", mysqli_connect_error());
            exit();
        }
        return $db;
    }

}
