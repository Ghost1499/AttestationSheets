<?php
// Загрузка классов "на лету"
function __autoload($className) {
	$filename = $className . '.php';
	// определяем класс и находим для него путь
	$expArr = explode('_', $className,2);
	if(empty($expArr[1]) OR $expArr[1] == 'Base'){
		$folder = 'core';
	}else{			
		switch($expArr[0]){
			case 'Controller':
				$folder = 'controllers';	
				break;
				
			case 'Model':
				$folder = 'models';	
				break;
				
			default:
				$folder = 'classes';
				break;
		}
	}
	// путь до класса
	$file = APP_PATH .DS. $folder . DS . $filename;
	// проверяем наличие файла
	if (file_exists($file) == false) {
		return false;
	}

	// подключаем файл с классом
	include ($file);
}
