<?php

use core\Controller;


class AuthController extends Controller
{
    public function index()
    {
        $this->view('login');
    }

    public function login()
    {
        $this->model->login();
        $user = $this->model->user;

        if (!$user){
            $this->session('status', 'Нет такого пользователя!');

            $this->view('login');
        }else{
            $this->session('status', 'Вы авторизировались!');
            $this->session('auth', $user);

            $this->redirect();
        }
    }

    public function out()
    {
        unset($_SESSION['auth']);
        $this->redirect('auth');
    }
}