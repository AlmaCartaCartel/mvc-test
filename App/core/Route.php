<?php

namespace core;

class Route
{
    public static function start()
    {
        // контроллер и действие по умолчанию
        $controller_name = 'Comments';
        $action_name = 'index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);
        // получаем имя контроллера
        if ( !empty($routes[1]) )
        {
            $controller_name = $routes[1];
        }

        // получаем имя экшена
        if ( !empty($routes[2]) )
        {
            $action_name = $routes[2];
        }

        // добавляем префиксы
        $model_name = $controller_name . 'Model';
        $controller_name = $controller_name . "Controller";


        // подцепляем файл с классом модели (файла модели может и не быть)

        $model_file = ucfirst($model_name).'.php';
        $model_path = "models\\".$model_name;

        // подцепляем файл с классом контроллера
        $controller_file = ucfirst($controller_name) .'.php';
        $controller_path = "app/controllers/".$controller_file;
        if(file_exists($controller_path))
        {
            include "app/controllers/".$controller_file;
        }
        else
        {
            /*
            правильно было бы кинуть здесь исключение,
            но для упрощения сразу сделаем редирект на страницу 404
            */
            Route::ErrorPage404();
        }
        // создаем контроллер
        $controller = new $controller_name;
        $controller-> model = new $model_path();
        $action = $action_name;

        if(method_exists($controller, $action))
        {
            // вызываем действие контроллера
            $controller->$action();
        }
        else
        {
            // здесь также разумнее было бы кинуть исключение
            Route::ErrorPage404();
        }

    }

    static function ErrorPage404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
//        header('HTTP/ 1.1 404 Not Found');
//        header("Status: 404 Not Found");
//        header('Location:'.$host.'404');
        echo $_POST['message'];
        die($host.'404');

    }

    static function redirect($route = '')
    {
        return header("Location: /{$route}");
    }
}
