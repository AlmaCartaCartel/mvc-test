<?php

namespace core;

class View
{
    public static function generate( $view, $data = null)
    {
        if(is_array($data)) {


            extract($data);
        }
        /*
        динамически подключаем общий шаблон (вид),
        внутри которого будет встраиваться вид
        для отображения контента конкретной страницы.
        */
        include str_replace('\\', '/', VIEWS_PATH.$view.'.php') ;
    }
}