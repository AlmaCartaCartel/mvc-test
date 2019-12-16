<?php

namespace core;

class Controller
{
    public $model;
    public $view;

    public function view($view, $data = null)
    {
        $v =  new View();
        $v -> generate($view, $data);
    }

    public function clear()
    {
        file_put_contents('W:\domains\test2/index.php', "<?php ini_set(\'display_errors\', 1); require_once \'App/index.php\'; use core\Route; Route::start();");
    }

}