<?php


    class Model_mark_on_exam extends Model_Base
    {
        public $mark_id;
        public $semester_course_id;
        public $subject_id;
        public $student_id;
        public $mark;
        public $attestation_number;

        public function fieldsTable()
        {
            return array('mark_id'=>'mark_id','semester_course_id' =>'semester_course_id','subject_id'=>'subject_id',
                'student_id'=>'student_id','mark'=>'mark','attestation_number'=>'attestation_number');
        }
    }