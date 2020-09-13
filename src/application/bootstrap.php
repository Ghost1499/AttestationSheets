<?php

    // подключаем файлы ядра

    /*require_once 'core/Model_Base.php';
    require_once 'core/View.php';
    require_once 'core/Controller.php';*/
    include 'config.php';

    $dbObject = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
    $dbObject->exec('SET CHARACTER SET utf8');
    /*
    Здесь обычно подключаются дополнительные модули, реализующие различный функционал:
        > аутентификацию
        > кеширование
        > работу с формами
        > абстракции для доступа к данным
        > ORM
        > Unit тестирование
        > Benchmarking
        > Работу с изображениями
        > Backup
        > и др.
    */

    include (SITE_PATH . DS . 'core' . DS . 'Core.php');
    $router = new Router();
    // задаем путь до папки контроллеров;
    try
    {
        $router->setPath(SITE_PATH .DS. 'controllers');
    }
    catch (Exception $e)
    {
        Router::ErrorPage404();
    }
    // запускаем маршрутизатор
    $router->start();

    //Router::start(); // запускаем маршрутизатор
