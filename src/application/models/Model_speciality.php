<?php


    class Model_speciality extends Model_Base
    {
        public $code;
        public $name;

        public function fieldsTable(){
            return array('speciality_code' => 'speciality_code','speciality_name' => 'speciality_name');
        }
    }