<?php

use core\Controller;

class RegisterController extends Controller
{
    public function index()
    {
        $this->view('register');
    }

    public function add()
    {
        $this->model->registerUser();
        $this->redirect('auth');
    }
}
