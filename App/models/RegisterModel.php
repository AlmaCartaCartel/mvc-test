<?php
namespace models;

use core\DataBase;
use core\Model;

class RegisterModel extends Model
{
    public static function registerUser()
    {
        $db = DataBase::db_connect();

        $user_name = $_POST['name'];
        if (strlen($user_name) < 5){
            return [
                'status' => 'Некоректное имя',
            ];
        }
        $user_email = $_POST['email'];
        if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)){
            return [
                'status' => 'Некоректный email',
            ];
        }
        $user_password = $_POST['password'];
        if (strlen($user_name) < 6){
            return [
                'status' => 'Некоректное имя',
            ];
        }
        $user_login = $_POST['login'];
        if (strlen ($user_name) < 5){
            return [
                'status' => 'Некоректный логин',
            ];
        }

        $query = $db->prepare("INSERT INTO `users` ( `name`, `email`, `password`, `login`) VALUES ( '$user_name', '$user_email', '$user_password', '$user_login');");
        $query->execute();
        return false;
    }
}