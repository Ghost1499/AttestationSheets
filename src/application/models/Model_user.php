<?php


    class Model_user extends Model_Base
    {

        public $id;
        public $login;
        public $password;
        public $type;

        public function __construct() { }

        public function fieldsTable()
        {
           return array('id'=>'user_id','login'=>'user_login','password'=>'user_password','type'=>'user_type');
        }
    }