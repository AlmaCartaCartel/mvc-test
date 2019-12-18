<?php
session_start();

use core\Controller;
use core\Route;
use core\View;
use models\RegisterModel;


class RegisterController extends Controller
{
    public function index()
    {
        $this->view('register');
    }

    public function add()
    {
        RegisterModel::registerUser();

        Route::redirect();
    }
}
