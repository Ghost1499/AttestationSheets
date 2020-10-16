<?php


    class Controller_authorization extends Controller
    {
        public function __construct() {
            parent::__construct();
            $this->model=new Model_user();
        }

        public function action_index(){
            $this->view->generate('login_view.php');
        }

        public function action_login(){

        }

    }