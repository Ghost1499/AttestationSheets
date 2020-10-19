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
        public function __construct($url) {
            $arr=parse_url($url);
            $this->path=$arr['path'] ;
            $this->params=null;
            if(isset($arr['query']))
                parse_str($arr['query'], $this->params);
        }
    }