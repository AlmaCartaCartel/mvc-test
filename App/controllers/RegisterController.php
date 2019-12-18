<?php

use core\Controller;
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
        $this->redirect('auth');
    }
}
