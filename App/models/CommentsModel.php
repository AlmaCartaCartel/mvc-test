<?php
namespace models;

use core\DataBase;
use core\Model;

class CommentsModel extends Model
{
    public static function pushMassage()
    {
        $db = DataBase::db_connect();
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        $mes = $_POST['message'];
        $comment_id = $_POST['comment_id'];
        $user_id = $_SESSION['auth']['id'];
        $user_name = $_SESSION['auth']['name'];

            $sth = $db->prepare("INSERT INTO comments (massage, user_id,user_name,comment_id) VALUES (:message, :user_id, :user_name, :comment_id)");
//            die(var_dump($sth));
            $sth->bindParam(':message', $mes);
            $sth->bindParam(':user_id', $user_id);
            $sth->bindParam(':user_name', $user_name);
            $sth->bindParam(':comment_id',$comment_id);

            $sth->execute();

            $sts = $db->prepare("SELECT * FROM comments ORDER BY id DESC LIMIT 1");
            $sts->execute();
            return $sts->fetch(\PDO::FETCH_ASSOC);
    }

    public static function getComments()
    {
        $nesting = NESTING_COMMENTS;

        $db = DataBase::db_connect();
        $query = $db->prepare("SELECT * FROM `comments` WHERE  `parent` <= '$nesting'");
        $query->execute();
        $comments = $query->fetchAll();

        return self::transformData($comments);
    }


    public static function transformData($comments, $id = 0, $inc = 0)
    {
        $parent = [];
        foreach ($comments as $comment){
            if ($comment['comment_id'] == $id  and $inc <= NESTING_COMMENTS){
                $comment['parent'] = $inc;
                $comment['answers'] = self::transformData($comments, $comment['id'], $inc + 1);
                array_push($parent, $comment);
            }
        }
        return $parent;
    }

}