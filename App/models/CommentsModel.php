<?php
namespace models;
session_start();

use core\DataBase;
use core\Model;

class CommentsModel extends Model
{
    public static function getChildrenCount($arrays)
    {
        $arr_count = 0;
        foreach ($arrays as $arr){
            if ($arr[5] > $arr_count){
                $arr_count = $arr[5];
            }
        }
        return $arr_count;
    }
    public static function pushMassage()
    {
        $db_comment = DataBase::db_connect();
        $mes = $_POST['message'];
        $id = $_POST['comment_id'];
        $user_id = $_SESSION['auth']['id'];
        $user_name = $_SESSION['auth']['name'];
        mysqli_query($db_comment,"INSERT INTO `comments` (`massage`, `user_id`, `user_name`,`comment_id`) VALUES ( '$mes' , '$user_id','$user_name', $id)");
    }

    public static function getComments()
    {
        $db = DataBase::db_connect();
        $query = mysqli_query($db, "SELECT * FROM `comments` WHERE comment_id IS NULL ");
        $query_child = mysqli_query($db, "SELECT * FROM `comments` WHERE comment_id IS NOT NULL ");

        $comments =  mysqli_fetch_all($query);
        $comments_child = mysqli_fetch_all($query_child);
        $count =  self::getChildrenCount($comments_child);

        return array($comments, $comments_child, $count);
    }



}