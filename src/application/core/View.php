<?php

    //namespace Core;
    class View
    {

        //public $template_view; // здесь можно указать общий вид по умолчанию.

        function generate($template_view, $content_view=null, $data = null)
        {


            if(is_array($data)) {

                // преобразуем элементы массива в переменные
                extract($data);
            }

            //print_r($data);
            /*
            динамически подключаем общий шаблон (вид),
            внутри которого будет встраиваться вид
            для отображения контента конкретной страницы.
            */
            include APP_PATH.DS.'views'.DS.$template_view;
        }
    }
