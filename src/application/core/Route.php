<?php


    //namespace Core;


    class Route
    {
        private $path;
        private $controller;
        private $action;

        public function __construct($path, $controller, $action='index') {

            $this->path = $path;
            $this->controller = $controller;
            $this->action = $action;
        }

        public function __get($name)
        {
            return $this->$name;
        }
        public static function getParams(){
            $parts=explode('/', $this->path);
            foreach ($parts as $part){
                if($part[0]==)
            }
        }

        public function tryGetTrack($path,&$track){
            $example_parts=explode('/',$this->$path);
            $current_parts=explode('/', $path);
            $params=array();
            $track=null;
            if(count($example_parts)!=count($current_parts)){
                return false;
            }
            $isSuccessfull=false;
            for($i=0;$i<count($example_parts);$i++){
                if(substr($example_parts[$i], 0,1)==":"){
                    $currPartName=substr($example_parts[$i],1);
                    $params[$currPartName]=$current_parts[$i];
                    continue;
                }
                if($example_parts[$i]==$current_parts[$i])
                {
                }
                else{
                    return false;
                }
            }
            if(count($params)==0)
                $params=null;
            $track=new Track($this->controller,$this->action,$params);
        }

    }