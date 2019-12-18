<?php


namespace models;


use core\DataBase;
use core\Model;

class AuthModel extends Model
{
    public $user;

    public function login()
    {
        $login = $_POST['login'];
        $password = $_POST['password'];


        $db = $this->connect();

        $query = mysqli_query($db, "SELECT * FROM `users` WHERE `login` = '$login' ") or  false;
        if ($query){
            $user =  mysqli_fetch_assoc($query);
            $this->user = $password == $user['password']? $user : false;
        }
    }
    public function dd()
    {
        die('ok');
    }
}