<?php
namespace models;

use core\DataBase;
use core\Model;

class RegisterModel extends Model
{
    public static function registerUser()
    {
        $db_connect = DataBase::db_connect();

        $user_name = $_POST['name'];
        $user_email = $_POST['email'];
        $user_password = $_POST['password'];
        $user_login = $_POST['login'];

        mysqli_query($db_connect,"INSERT INTO `users` ( `name`, `email`, `password`, `login`) VALUES ( '$user_name', '$user_email', '$user_password', '$user_login');");
    }
}