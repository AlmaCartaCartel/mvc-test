<?php

use core\Controller;


class CommentsController extends Controller
{
    public function index()
    {
        $comments = $this->model->getComments();
        $this->view('home', $comments);
    }

    public function add()
    {
        $this->model->pushMassage();

        $this->redirect();
    }
}
