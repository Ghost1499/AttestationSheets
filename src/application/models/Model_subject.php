<?php


    class Model_subject extends Model_Base
    {
        public $id;
        public $name;

        public function fieldsTable(){
            return array('id' => 'subject_id','name' => 'subject_name');
        }

    }