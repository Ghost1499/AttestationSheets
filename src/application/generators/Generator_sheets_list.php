<?php


    class Generator_sheets_list
    {
        /**
         * @var string
         */
        private $action;
        private $selectionNames;

        public function __construct($selectionNames,$action='/sheets/sheet')
        {
            $this->action=$action;
            $this->selectionNames=$selectionNames;
        }
        public function GenerateSheetList($data){
            if(!is_array($data)){
                throw new Exception("SheetList error");
            }
            foreach ($data as $item){
                $this->printRow($this->action, $item);
            }
        }
        private function buildQuery($action,$queryParams){
            return $action."?" . http_build_query($queryParams);
        }

        private function printRow($action,$rowData/*$studiyng_year,$semester_number,$spec_code,$spec_name,$course_number,$group_number*/)
        {
            if(!is_array($rowData)){
                throw new Exception("Row error");
            }
            $url=$this->buildQuery($action, array_intersect_key($rowData,array_flip($this->selectionNames)));
            //var_dump($rowData);
            echo "<div class=\"sheet shadowed padding btn\" onclick=\"document.location='".$url."'\"> 
            <h1>Ведомость ".$rowData['course_number'] ." курс</h1>
            <p>".$rowData['spec_name']." ".$rowData['spec_code']." ".$rowData['semester_number']." семестр ".$rowData['group_number']." группа ".$rowData['studiyng_year']." год</p>
            </div>";
        }

    }