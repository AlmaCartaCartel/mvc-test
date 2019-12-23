<?php


namespace models;


use core\DataBase;
use core\Model;

class AuthModel extends Model
{
    public static function login()
    {
        $login = $_POST['login'];
        $password = $_POST['password'];

        $db = DataBase::db_connect();

        $query = $db ->prepare("SELECT * FROM `users` WHERE `login` = '$login' ");
        $query -> execute();
        if ($query){
            $user = $query -> fetch();
            return $password == $user['password']? $user : false;
        }
    }
}