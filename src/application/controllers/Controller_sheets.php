<?php


    class Controller_sheets extends Controller
    {
        public $students;
        public $marks;
        /**
         * @var array
         */
        private $selection_names;

        public function __construct($selectionNames = ['studiyng_year', 'semester_number', 'speciality_code', 'group_number'])
        {
            parent::__construct();
            $this->marks = new Model_mark_on_exam();
            $this->content_view = 'main_view.php';
            $this->selection_names = $selectionNames;
        }

        private function checkAuthentication(){
            if(!isset($_SESSION['user_id'])){
                Router::ErrorPage404();
//                die('');
            }
        }

        public function action_index($params = null)
        {
            session_start();
//            print_r($_SESSION);
            $this->checkAuthentication();

            $select = array('select' => 'DISTINCT mark_on_exam.semester_course_id AS sem_course_id,'. /*, mark_on_exam.attestation_number as att_number*/ 'semester_course.semester_number as semester_number,semester_course.course_number as course_number,semester_course.studiyng_year as studiyng_year,speciality.speciality_name as spec_name, semester_course.speciality_code as speciality_code, student.group_number as group_number',

                'join' => "LEFT JOIN semester_course ON mark_on_exam.semester_course_id=semester_course.semester_course_id
LEFT JOIN speciality ON semester_course.speciality_code=speciality.speciality_code
LEFT JOIN student ON semester_course.semester_course_id=student.semester_course_id", // условие

                'order' => 'semester_course.semester_number,semester_course.studiyng_year DESC,mark_on_exam.attestation_number, semester_course.speciality_code,student.group_number' // сортируем
            );
//            print_arr($select);
            $this->marks = new Model_mark_on_exam($select); // создаем объект модели
            $sheets_menu_data = $this->marks->getAllRows(); // получаем все строки
//            print_arr($sheets_menu_data);

            $where = $this->getWhere($params);
            if ($where != '')
                $select['where'] = $where;

//            print_arr($select);
            $this->marks = new Model_mark_on_exam($select); // создаем объект модели
            $sheets_data = $this->marks->getAllRows(); // получаем все строки
//            print_arr($sheets_data);
            if(!$sheets_data){
                $sheets_data=[];
            }
            
            $selectionNames = $this->selection_names;
            $data = compact('sheets_menu_data', 'sheets_data', 'selectionNames');
            $this->view->generate($this->template_view, $this->content_view, $data);
        }

        /**
         * @param array $params
         */
        public function action_sheet($params)
        {
            session_start();
            $this->checkAuthentication();
            if (!is_array($params))
            {
                throw new Exception("Controller_sheets action_sheet error");
            }
            if (count(array_diff_key(array_flip($this->selection_names), $params)) != 0)
            {
                throw new Exception("Controller_sheets action_sheet error");
            }
            //            print_r($params);
            $content_view = 'sheet_view.php';
            $select = $this->selectSheet($params);
            //            print_r($select);
            $this->marks = new Model_mark_on_exam($select); // создаем объект модели
            $sheet = $this->marks->getAllRows(); // получаем все строки
            //            print_r($sheet);
            $table_data=$this->getDataForSheetTable($sheet);
//            print_arr($table_data);

            $this->view->generate($this->template_view, $content_view, $table_data);
        }


        private function getWhere($params)
        {
            if ($params != null)
            {
                $where = '';
                $firstWhere = true;

                foreach ($params as $key => $value)
                {
                    if ($value == "all")
                    {
                        continue;
                    }
                    if ($value == '')
                        throw new Exception('Controller_sheets getWhere error');
                    if (!$firstWhere)
                    {
                        $where .= " AND ";

                    }
                    if ($firstWhere)
                        $firstWhere = false;
                    if ($key == 'speciality_code')
                        $where .= 'speciality.';
                    $where .= $key . "='" . $value . "'";
                }
                return $where;
            }
/*            else
            {
                throw new Exception('Controller_sheets getWhere error');
            }*/
        }

        /**
         * @param $params
         * @return array
         */
        private function selectSheet($params)
        {
            $select = array('select' => ' mark_on_exam.mark_id, student.name as name,
                     student.surname as surname, mark, attestation_number,
                      subject_on_semester_course.accounting_type as acc_type, subject.subject_name as subject_name,
                       speciality.speciality_name,speciality.speciality_code,semester_course.course_number,semester_course.semester_number,
                       semester_course.studiyng_year,student.group_number, student.student_id',

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
                'order' => 'semester_course.studiyng_year ASC, semester_course.semester_number ASC, semester_course.speciality_code, student.group_number,student.name,student.student_id, mark_on_exam.attestation_number, mark_on_exam.subject_id,student.surname' // сортируем

            );
            $where = $this->getWhere($params);
            if ($where != '')
                $select['where'] = $where;
            return $select;
        }

        private function getDataForSheetTable($sheet)
        {

            if(!is_array($sheet))
                throw new Exception("Controller_sheets getDataForSheetTable error");
//            var_dump($sheet);

            if (!function_exists('array_key_first')) {
                function array_key_first(array $arr) {
                    foreach($arr as $key => $unused) {
                        return $key;
                    }
                    return NULL;
                }
            }
//            print_arr($sheet);
            $temp_row=$sheet[array_key_first($sheet)];

            $students = [];
            $subjects=[];
            foreach ($sheet as $key=>$value){
                $subjects[$key]['subject_name']=$value['subject_name'];
                $subjects[$key]['acc_type']=$value['acc_type'];
//                print_r($value);
//                echo '<br />';
            }
//            print_arr($subjects);

            $subjects= array_unique($subjects,SORT_REGULAR);
            $attsCount=3;
            $attsOnSubject=[];
//            print_arr($subjects);
            foreach ($subjects as $subject)
            {
                $subject_name=$subject['subject_name'];
                $subject_row=array_filter($sheet,function ($item) use ($subject_name) {
                    return $item['subject_name']== $subject_name;
                });
                $arr=array_unique(array_column($subject_row, 'attestation_number'),SORT_REGULAR);
                natsort($arr);
                $attsOnSubject[$subject_name]=$arr;
            }
//            print_arr($attsOnSubject);
            while (count($sheet) != 0)
            {
                $student=[];
                $student_id=$sheet[array_key_first($sheet)]['student_id'];
                while($sheet and $sheet[array_key_first($sheet)]['student_id']==$student_id ){
                     array_push( $student,array_shift($sheet));
                }
//                print_arr($student);
//                echo ' <br /> ';
                array_push($students,$student);
                $student=[];

            }

            $student_rows=[];
//            print_arr($students);
            foreach ($students as $student_number => $student)
            {
//                print_arr($student);
                $student_row=[];
                $column_names=['student_id', 'name','surname'];
                foreach ($column_names as $name){
                    $student_row[$name]=$student[array_key_first($student)][$name];
                }
//                print_arr($student_row);
                $temp_student=$student;
                foreach ($attsOnSubject as $subject=>$attsNumbers){
//                    $subjectAddedIndicator=false;
                    foreach ($attsNumbers as $attsNumber){
                        $nextAttIndicator=false;
                        foreach ($temp_student as $key=>$student_note) {
//                            print_arr($student_note);
//                            echo "<br /> ".$subject.' '.$attsNumber.' <br />';
                            if( $student_note['subject_name']==$subject and $student_note['attestation_number']=$attsNumber){
                                $student_row[$subject][$attsNumber]=$student_note['mark'];
//                                print_arr($student_row);
                                $subjectAddedIndicator=true;
                                $nextAttIndicator=true;
                                unset($temp_student[$key]);
                                break;
                            }
                        };
                        if(!$nextAttIndicator){
                            $student_row[$subject][$attsNumber]=0;
                        }
                    }
                    $student_row[$subject]['result']=round((double)array_sum($student_row[$subject])/count($attsNumbers));
//                    print_arr($student_row);


                }
//                print_arr($student_row);
                array_push($student_rows,$student_row);
            }
            $data=compact('student_rows','subjects','attsCount');
//            print_arr($temp_row);
            $data['course_number']=$temp_row['course_number'];
            $data['semester_number']=$temp_row['semester_number'];
            $data['studiyng_year']=$temp_row['studiyng_year'];
            $data['group_number']=$temp_row['group_number'];
            $data['speciality_name']=$temp_row['speciality_name'];
            $data['speciality_code']=$temp_row['speciality_code'];
            return $data;

        }
    }