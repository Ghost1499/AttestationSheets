<?php


    class Model_subject_on_semester_course extends Model_Base
    {
        public $subject_id;
        public $semester_course_id;
        public $accounting_type;


        public function fieldsTable(){
            return array('subject_id' => 'subject_id','semester_course_id' => 'semester_course_id','accounting_type'=>'accounting_type');
        }

    }