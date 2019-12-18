<?php
session_start();
use core\Controller;
use core\Route;
use core\View;
use models\AuthModel;


class AuthController extends Controller
{
    public function index()
    {
        $this->view('login');
    }

    public function login()
    {
        $user = AuthModel::login();

        if (!$user){
            $this->session('status', 'Нет такого пользователя!');

            $this->view('login');
        }else{
            $this->session('status', 'Вы авторизировались!');

            $this->session('auth', $user);

            $this->redirect('home');
        }
    }

    public function out()
    {
        unset($_SESSION['auth']);
        $this->redirect('auth');
    }
}