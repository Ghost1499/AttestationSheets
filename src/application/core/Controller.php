<?php
    //namespace Core;

    abstract class Controller
    {
        public $view;
        public $template_view='template_view.php';
        public $content_view;

        public function __construct(){
            $this->view=new View();


        }
        public abstract function action_index($params=null);

        /**
         * @param string $msg
         */
        public static function phpAlert($msg) {
            return '<script type="text/javascript">alert("' . $msg . '")</script>';
            //            $(\'body\').ready(function() { alert("' . $msg . '");});</script>';
        }

    }