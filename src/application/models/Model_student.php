<?php


    class Model_student extends Model_Base
    {
        public $id;
        public $semester_course_id;
        public $subject_id;
        public $student_id;
        public $mark;
        public $attestation_number;

        public function fieldsTable(){
            return array('id' => 'attestation_id','semester_course_id' => 'semester_course_id','subject_id' => 'subject_id','student_id' => 'student_id','mark' => 'mark','attestation_number' => 'attestation_number');
        }

    }