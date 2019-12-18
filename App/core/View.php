<?php

namespace core;

class View
{
    public static function generate( $view, $data = null)
    {
            // преобразуем элементы массива в переменные
//        session_start();
//        $_SESSION['comments'] = $data;
        if(is_array($data)) {

            // преобразуем элементы массива в переменные
            extract($data);
        }
        /*
        динамически подключаем общий шаблон (вид),
        внутри которого будет встраиваться вид
        для отображения контента конкретной страницы.
        */
        include VIEWS_PATH.$view.'.php';
    }
}