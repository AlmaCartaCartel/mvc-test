<?php
namespace models;

use core\DataBase;
use core\Model;

class CommentsModel extends Model
{
    public static function pushMassage()
    {
        $mes = $_POST['message'];
        $db = DataBase::db_comments();

        mysqli_query($db ,"INSERT INTO `comments` (`id`, `message`, `user_id`, `date`) VALUES (NULL, '$mes', NULL, NULL)");
    }

    public static function getComments()
    {
        $db = DataBase::db_comments();
        return mysqli_free_result(mysqli_query($db, "SELECT * FROM `comments` "));
    }
}