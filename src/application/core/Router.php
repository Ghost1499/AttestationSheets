<?php
    // класс роутера

    //namespace Core;
    class Router
    {
        private $path;
        private $routes;
        //private $args = array();

        /**
         * Router constructor.
         */
        function __construct()
        {
            $this->routes=require (APP_PATH.DS.'config/routes.php');
            //echo APP_PATH.DS.'config/routes.php';
            //print_r($routes);

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

        /**
         * @param MyUrl $url
         * @return Track|null
         * @throws Exception
         */
        private function getTrack($url/*,&$file, &$controller, &$action, &$args*/)
        {
            $track=null;

            /*if (empty($url))
            {
                $track = new Track();
                return $track;
            }*/
            foreach ($this->routes as $current_route){
                //var_dump($current_route);
                if($current_route->tryGetTrack($url,$track)){
                    break;
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
            return empty($val) ? '/' : $val;
        }
        function start()
        {

            $route=$this->_setRoute($_SERVER['REQUEST_URI']);
//            echo $route;
            $url=new MyUrl($route);
            // Анализируем путь
            //$track=null;
            try{
                $track=$this->getTrack($url);
            }
            catch (Exception $e){

                Router::ErrorPage404();
            }

            //echo $file,$controller,$action,$args;
            // Проверка существования файла, иначе 404
            $file=$this->getFile($track);
            //echo $file;
            if (is_readable($file) == false)
            {
               Router::ErrorPage404();
            }

            // Подключаем файл
            include($file);
            // Создаём экземпляр контроллера
            $class = $this->getClass($track);
            $controller = new $class();
            $action=$this->getAction($track);
            // Если экшен не существует - 404
            if (is_callable(array($controller, $action)) == false)
            {
                //echo fff;
                Router::ErrorPage404();
            }

            // Выполняем экшен
            try
            {
                $controller->$action($track->params);

            }
            catch (Exception $ex){
                Router::ErrorPage404();
            }
        }
        private function getFile($track){
            $file = $this->path ."Controller_". $track->controller . '.php';
            return $file;
        }
        private function getClass($track){
            $class ="Controller_". $track->controller;
            return $class;
        }
        private function getAction($track){
            $action ="action_". $track->action;
            return $action;
        }
        static function ErrorPage404()
        {
            $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
            header('HTTP/1.1 404 Not Found');
            header("Status: 404 Not Found");
            header('Location:' . $host . '404');
        }
    }
