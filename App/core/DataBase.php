<?php


namespace core;


class DataBase
{
    static function db_connect()
    {
        require_once 'data-base.config.php';

        return mysqli_connect($host, $login, $password , $db_name);
    }

}
