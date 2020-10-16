<?php


    class Controller_sheets extends Controller
    {
        public $students;
        public $marks;

        public function __construct()
        {
            parent::__construct();
            $this->marks = new Model_mark_on_exam();
            $this->content_view='main_view';
        }

        public function action_index()
        {
            $this->view->generate($this->template_view,$this->content_view);

        }

        /**
         * @param array $params
         */
        public function action_sheets($params)
        {
            $mark_id = (isset($_GET['id'])) ? (int)$_GET['id'] : false;
            $mark_id = (isset($_GET['id'])) ? (int)$_GET['id'] : false;
            $mark_id = (isset($_GET['id'])) ? (int)$_GET['id'] : false;
            $mark_id = (isset($_GET['id'])) ? (int)$_GET['id'] : false;
            if (!$mark_id)
            {
                $select = array('select' => 'SELECT mark_on_exam.mark_id, student.name as name,
                     student.surname as surname, mark, attestation_number,
                      subject_on_semester_course.accounting_type as acc_type, subject.subject_name as subject_name,
                       speciality.speciality_name,semester_course.course_number,semester_course.semester_number,
                       semester_course.studiyng_year,student.group_number',

                    'join' => "LEFT JOIN `subject_on_semester_course`
                        ON mark_on_exam.subject_id=subject_on_semester_course.subject_id AND mark_on_exam.semester_course_id=subject_on_semester_course.semester_course_id
                        LEFT JOIN `subject`
                        ON mark_on_exam.subject_id=subject.subject_id
                        LEFT JOIN `student`
                        ON student.student_id=mark_on_exam.student_id
                        LEFT JOIN `speciality`
                        ON student.speciality_code=speciality.speciality_code
                        LEFT JOIN `semester_course`
                        ON mark_on_exam.semester_course_id=semester_course.semester_course_id", // условие

                    'order' => 'semester_course.studiyng_year ASC, semester_course.semester_number ASC, semester_course.speciality_code, student.group_number, mark_on_exam.attestation_number, mark_on_exam.subject_id,student.surname, student.name' // сортируем
                );
                /*if($mark_id){
                    'where'=>''
                }*/
                $this->marks=new Model_mark_on_exam($select); // создаем объект модели
                $sheets = $this->marks->getAllRows(); // получаем все строки
            }
            else
            {
                $articles = false;
            }
        }
    }