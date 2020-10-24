<?php


    /**
     * @property string path
     * @property array params
     */
    class MyUrl
    {
        public $url;
        public $params;

        /**
         * MyUrl constructor.
         * @param string $url
         */
        public function __construct($url,$params=null) {
            $arr=parse_url($url);
            $this->path=$arr['path'] ;
            if(is_null($params)){
                $params=[];
            }
            $this->params=$params;
            $query_params=null;
            if(isset($arr['query'])){
                parse_str($arr['query'], $query_params);
                $this->params=array_merge($query_params,$params);
            }
        }
    }