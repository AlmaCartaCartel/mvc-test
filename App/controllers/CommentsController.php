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
        CommentsModel::pushMassage();

        $this->redirect();
    }
}
