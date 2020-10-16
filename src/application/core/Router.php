<?php
    // класс роутера

    //namespace Core;
    class Router
    {
        private $path;
        private $routes;
        private $args = array();

        function __construct()
        {
            $routes=require APP_PATH.DS.'config/routes.php';
            print_r($routes);

        }

        // задаем путь до папки с контроллерами
        public function setPath($path)
        {
            $path = rtrim($path, '/\\');
            $path .= DS;
            // если путь не существует, сигнализируем об этом
            if (is_dir($path) == false)
            {
                throw new Exception('Invalid controller path: `' . $path . '`');
            }
            $this->path = $path;
        }

        // определение контроллера и экшена из урла
        private function getTrack($route/*,&$file, &$controller, &$action, &$args*/)
        {
            $track=null;
            if (empty($route))
            {
                $track = new Track();
            }

            foreach ($this->routes as $current_route){
                if($current_route->tryGetTrack($route,$track)){
                    continue;
                }
            }
            if($track==null){
                throw new Exception("Appropriate route not found");
            }
            return $track;
            // Получаем части урла
            /*$route = trim($route, '/\\');
            $parts = explode('/', $route);

            // Находим контроллер
            $cmd_path = $this->path;*/
            /*foreach ($parts as $part)
            {
                $fullpath = $cmd_path . $part;

                // Проверка существования папки
                if (is_dir($fullpath))
                {
                    $cmd_path .= $part . DS;
                    array_shift($parts);
                    continue;
                }

                // Находим файл
                if (is_file($cmd_path . 'Controller_' . $part . '.php'))
                {
                    $controller = $part;
                    array_shift($parts);
                    break;
                }
            }*/
            // если урле не указан контролер, то испольлзуем поумолчанию index
            /*if (empty($controller))
            {
                $controller = $this->defaultController;
            }
            // Получаем экшен
            $action = 'action_' . array_shift($parts);
            if ($action == 'action_')
            {
                $action = 'action_' . $this->defaultAction;
            }
            $controller = 'Controller_' . $controller;
            $file = $cmd_path . $controller . '.php';
            $args = $parts;*/
        }

        private function _setRoute($val){
            return empty($val) ? '' : $val;
        }
        function start()
        {
            $route=$this->_setRoute($_GET['route']);
            unset($_GET['route']);
            // Анализируем путь
            $track=$this->getTrack($route);
            //echo $file,$controller,$action,$args;
            // Проверка существования файла, иначе 404

            if (is_readable($file) == false)
            {
                die ('404 Not Found');
            }

            // Подключаем файл
            include($file);
            // Создаём экземпляр контроллера
            $class = $controller;
            $controller = new $class();

            // Если экшен не существует - 404
            if (is_callable(array($controller, $action)) == false)
            {
                die ('404 Not Found');
            }

            // Выполняем экшен
            $controller->$action($args);
        }

        static function ErrorPage404()
        {
            $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
            header('HTTP/1.1 404 Not Found');
            header("Status: 404 Not Found");
            header('Location:' . $host . '404');
        }
    }
