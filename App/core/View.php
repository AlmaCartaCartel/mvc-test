<?php

namespace core;

class View
{
    function generate($content_view, $data = null)
    {

        if(is_array($data)) {

            // преобразуем элементы массива в переменные
            var_dump($data);
            extract($data);
        }
        /*
        динамически подключаем общий шаблон (вид),
        внутри которого будет встраиваться вид
        для отображения контента конкретной страницы.
        */
        include 'App/Views/'.$content_view. '.php';
    }
}