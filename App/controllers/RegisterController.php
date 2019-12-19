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
        $result = RegisterModel::registerUser();
        if ($result){
            $this->session('status', $result['status']);
            $this->redirect('register');
            exit;
        }
        $this->redirect('auth');
    }
}
