<?php


namespace core;


class DataBase
{
    static function db_connect()
    {
        return mysqli_connect(HOST, LOGIN, PASSWORD , DB_NAME);
    }

}
