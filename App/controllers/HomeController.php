<?php

use core\Controller;
use models\CommentsModel;

class HomeController extends Controller
{
    public function index()
    {

        $comments = CommentsModel::getComments();
        $this->view('home', $comments);
    }


}