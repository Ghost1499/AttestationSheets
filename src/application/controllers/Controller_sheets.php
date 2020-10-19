<?php


    class Controller_sheets extends Controller
    {
        public $students;
        public $marks;

        public function __construct()
        {
            parent::__construct();
            $this->marks = new Model_mark_on_exam();
            $this->content_view = 'main_view.php';
        }

        public function action_index($params = null)
        {
            /*$semester_number = (isset($params['semester_number'])) ? (int)$params['$semester_number'] : false;
            $studiyng_year = (isset($params['studiyng_year'])) ? (int)$params['studiyng_year'] : false;
            $attestation_number = (isset($params['attestation_number'])) ? (int)$params['attestation_number'] : false;
            $spec_code = (isset($params['speciality_code'])) ? (int)$params['speciality_code'] : false;
            $group_id = (isset($params['group_id'])) ? (int)$params['group_id'] : false;*/

            $select = array('select' => 'DISTINCT mark_on_exam.semester_course_id AS sem_course_id, mark_on_exam.attestation_number as att_number, semester_course.semester_number as semester_number,semester_course.studiyng_year as studiyng_year,speciality.speciality_name as spec_name, semester_course.speciality_code as spec_code, student.group_number as group_number',

                'join' => "LEFT JOIN semester_course ON mark_on_exam.semester_course_id=semester_course.semester_course_id
LEFT JOIN speciality ON semester_course.speciality_code=speciality.speciality_code
LEFT JOIN student ON semester_course.semester_course_id=student.semester_course_id", // условие

                'order' => 'semester_course.semester_number,semester_course.studiyng_year,mark_on_exam.attestation_number, semester_course.speciality_code,student.group_number' // сортируем
            );
            $this->marks = new Model_mark_on_exam($select); // создаем объект модели
            $sheets_menu_data = $this->marks->getAllRows(); // получаем все строки
            if ($params != null)
            {
                $where = '';
                $firstWhere = true;

                foreach ($params as $key => $value)
                {
                    if($value=="all"){
                        continue;
                    }
                    if ($firstWhere)
                    {
                        $where .= $key . "='" . $value."'";
                        $firstWhere = false;
                    }
                    else
                    {
                        $where .= " AND " . $key . "='" . $value."'";
                    }
                }
                $select['where'] = $where;
            }
            //print_r(  $select);

            $this->marks = new Model_mark_on_exam($select); // создаем объект модели
            $sheets_data = $this->marks->getAllRows(); // получаем все строки
            $data=compact('sheets_menu_data','sheets_data');
            $this->view->generate($this->template_view, $this->content_view, $data);
        }

        /**
         * @param array $params
         */
        public function action_sheet($params)
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
                $this->marks = new Model_mark_on_exam($select); // создаем объект модели
                $sheets = $this->marks->getAllRows(); // получаем все строки
            }
            else
            {
                $articles = false;
            }
        }

    }