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
        include str_replace('core',"views\\{$view}.php",__DIR__);
    }
}