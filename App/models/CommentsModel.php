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
        $query = mysqli_query($db, "SELECT * FROM `comments` ");

        $comments =  mysqli_fetch_all($query, MYSQLI_ASSOC);

        return self::transformData($comments);

    }

    public static function transformData($comments, $id = null)
    {
        $parent = [];
        foreach ($comments as $comment){
            if ($comment['comment_id'] === $id){

                $comment['answers'] = self::transformData($comments, $comment['id']);
                array_push($parent, $comment);
            }
        }
        return $parent;
    }

}