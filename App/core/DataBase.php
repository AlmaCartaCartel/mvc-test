<?php


namespace core;


class DataBase
{
    static function db_comments()
    {
        return mysqli_connect('localhost', 'root', '', 'test');
    }
}