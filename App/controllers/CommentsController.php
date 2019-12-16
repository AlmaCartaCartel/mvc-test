<?php
use core\Controller;
use core\Route;

use models\CommentsModel;

class CommentsController extends Controller
{
    public function index()
    {
        $this->view('home.php');
    }

    public function add()
    {
        CommentsModel::pushMassage();
        Route::redirect();
    }
}
