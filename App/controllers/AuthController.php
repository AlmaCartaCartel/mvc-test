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
        $this->view->generate('login');
    }

    public function login()
    {
        $user = AuthModel::login();

        if (!$user){
            $this->session('status', 'Нет такого пользователя!');
            Route::redirect('auth');
        }else{
            $this->session('status', 'Вы авторизировались!');
            $this->session('auth', $user);

            Route::redirect('home');
        }
    }

    public function out()
    {
        unset($_SESSION['auth']);
        $this->redirect('auth');
    }
}