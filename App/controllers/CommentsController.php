<?php

use core\Controller;
use models\CommentsModel;


class CommentsController extends Controller
{
    public function index()
    {
        $comments = CommentsModel::getComments();
        $this->view('home', $comments);
    }

    public function add()
    {
        $comment = CommentsModel::pushMassage();
        $comment ? die(json_encode($comment)) : die();

    }

    public function getComments()
    {
        $comments = json_encode(CommentsModel::getComments());

        die($comments);
    }
}
