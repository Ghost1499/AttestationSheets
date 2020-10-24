<?php


    class Model_user extends Model_Base
    {

        public $user_id;
        public $user_login;
        public $user_password;
        public $user_type;


        public function fieldsTable()
        {
           return array('user_id'=>'user_id','user_login'=>'user_login','user_password'=>'user_password','user_type'=>'user_type');
        }
    }