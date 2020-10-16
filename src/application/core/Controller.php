<?php
    //namespace Core;

    abstract class Controller
    {
        public $view;
        public $template_view='template_view';
        public $content_view;

        public function __construct(){
            $this->view=new View();


        }
        public abstract function action_index();

    }