<?php


    //namespace Core;


    class Track
    {
        private $controller;
        private $action;
        private $params;

        public function __construct($controller='authorization',$action='index',$params=null) {
            $this->controller=$controller;
            $this->action = $action;
            $this->params = $params;
        }

        public function __get($name)
        {
            return $this->$name;
        }

    }