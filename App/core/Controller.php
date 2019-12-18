<?php
namespace core;

class Controller
{
    public $model;
    public $view;

    public function session($status, $value)
    {
        $_SESSION[$status] = $value;
    }

    public function view($view, $data = null){
        View::generate($view, $data);
    }

    public function redirect($route = '')
    {
        Route::redirect($route);
    }
}