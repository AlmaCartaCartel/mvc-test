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

        $query = mysqli_query($db, "SELECT * FROM `users` WHERE `login` = '$login' ") or  false;
        if ($query){
            $user =  mysqli_fetch_assoc($query);
            return $password == $user['password']? $user : false;
        }
    }
}