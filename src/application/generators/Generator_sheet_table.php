<?php


    class Generator_sheet_table
    {
        public function __construct($tableId='attestation-table',$tableClass='display-center') {
            $this->attsCount=3;
            $this->attNames=[];
            for($i=1;$i<$this->attsCount+1;$i++){
                $this->attNames[$i-1]=$i;
            }
            $this->attNames[$this->attsCount]='Среднее';
            $this->tableId=$tableId;
            $this->tableClass=$tableClass;
            $this->resCellBgcolorEx='LightSalmon';
            $this->resCellBgcolorCredit='PaleGreen';

        }
        public function GenerateTable($subjects,$student_rows){

            $this->printTable($this->tableId,$this->tableClass,$subjects,$this->attsCount,$this->attNames,$student_rows,$this->resCellBgcolorEx,$this->resCellBgcolorCredit);
        }
        private function printTable($tableId=0,$tableClass=0,$subjects,$attsCount,$attNames,$student_rows,$resCellBgcolorEx,$resCellBgcolorCredit){
            echo "<table id=\"attestation-table\"
           class=\"display-center\">";
            $this->printHead($subjects, $attsCount,$attNames);
            $this->printBody($student_rows, $subjects, $attsCount,$resCellBgcolorEx,$resCellBgcolorCredit);
//            $this->printRow([['value'=>5],['value'=>6]]);
//            $this->printRow([['value'=>7],['value'=>8]]);
            echo "</table>";
        }
        private function printHead($subjects,$attsCount,$attNames){
            /*if(){

            }*/
            $resAttsCount=$attsCount+1;
            $tag='th';
            echo "<thead>";
            $subjectNamesRow=[];
            $subjectTypesRow=[];
            $subjectAttsRow=[];


            array_push($subjectNamesRow,['value'=>'№','rowspan'=>'3','tag'=>$tag]);
            array_push($subjectNamesRow,['value'=>'Ф.И.О.','rowspan'=>'3','tag'=>$tag]);
            foreach ($subjects as $subject){
                $subjNameCellData=[];
                $subjTypeCellData=[];

                $subjNameCellData['value']=$subject['subject_name'];
                $subjNameCellData['rowspan']=1;
                $subjNameCellData['colspan']=$resAttsCount;
                $subjNameCellData['tag']=$tag;

                $subjTypeCellData['value']=$subject['acc_type'];
                $subjTypeCellData['rowspan']=1;
                $subjTypeCellData['colspan']=$resAttsCount;
                $subjTypeCellData['tag']=$tag;

                foreach ($attNames as $att_name){
                    $subjAttCellData=[];
                    $subjAttCellData['value']=$att_name;
                    $subjAttCellData['tag']=$tag;
                    array_push($subjectAttsRow,$subjAttCellData);
                }

                array_push($subjectNamesRow,$subjNameCellData);
                array_push($subjectTypesRow,$subjTypeCellData);
            }
            $this->printRow($subjectNamesRow);
            $this->printRow($subjectTypesRow);
            $this->printRow($subjectAttsRow);

            echo "</thead>";
        }
        private function printBody($student_rows,$subjects,$attsCount,$resCellBgcolorEx,$resCellBgcolorCredit){
            $resAttsCount=$this->attsCount+1;
            echo "<tbody>";
            foreach ($student_rows as $key=>$student_row){
                $rowData=[];
                $numberCellData=[];
                $numberCellData['value']=$key;
                array_push($rowData,$numberCellData);


                $initialsCellData=[];
                $initialsCellData['value']=$this->getStudInitials($student_row['surname'],$student_row['name']);
                array_push($rowData,$initialsCellData);


                foreach ($subjects as $subject){
                    $subject_name=$subject['subject_name'];
                    for($attNumber=1;$attNumber<$attsCount+1;$attNumber++){
                        $attMarkCellData=[];
                        if(isset($student_row[$subject_name][$attNumber])){
                            $attMarkCellData['value']=$student_row[$subject_name][$attNumber];
                        }
//                        print_r($attMarkCellData);
                        array_push($rowData,$attMarkCellData);
                    }
                    $attMarkCellData=[];
                    if(isset($student_row[$subject_name]['result'])){
                        $attMarkCellData['value']=$student_row[$subject_name]['result'];
                        if($subject['acc_type']=='exam')
                            $attMarkCellData['bgcolor']=$resCellBgcolorEx;
                        else
                            $attMarkCellData['bgcolor']=$resCellBgcolorCredit;

                    }
                    array_push($rowData,$attMarkCellData);

                }
                $this->printRow($rowData);
//                print_r($rowData);
                /*echo "<br>";
                echo "<br>";*/

            }

            echo "</tbody>";
        }
        /*private function addAttMarkCellData($value,&$rowData){
            $attMarkCellData=[];
            if(isset($student_row[$subject_name][$attNumber])){
                $attMarkCellData['value']=$student_row[$subject_name][$attNumber];
            }
            array_push($rowData,$attMarkCellData);
        }*/
        /**
         * @param string $surname
         * @param $string $name
         * @return string
         */
        private function getStudInitials($surname, $name){
            $initials=$surname;
            $parts=explode(' ', $name);

            foreach ($parts as $part){

                $initials.=' '.mb_substr($part, 0,1).'.';
            }
            return $initials;

        }
        private function printRow($rowData){
            if(!is_array($rowData)){
                throw new Exception("PrintRow error");
            }
            echo "<tr>";
            foreach ($rowData as $cellData){
//                print_r($cellData);
                /*if(!is_array($cellData)){
                    throw new Exception("PrintRow error");
                }
                extract($cellData);
//                echo $value.' ';
                if(!isset($value)){
                    $value='';
                }
                if(empty($rowspan)){
                    $rowspan=1;
                }
                if(empty($colspan)){
                    $colspan=1;
                }*/
                $this->printCell($cellData,$value,$colspan,$rowspan);
            }
            echo "</tr>";
        }
        private function printCell($cellData/*, $value,$colspan=1,$rowspan=1*/){
            if(!is_array($cellData)){
                throw new Exception("PrintCell error");
            }
            extract($cellData);
            //                echo $value.' ';
            if(!isset($value)){
                $value='';
            }
            if(empty($rowspan)){
                $rowspan=1;
            }
            if(empty($colspan)){
                $colspan=1;
            }
            if(is_null($value)){
                throw new Exception("PrintCell error");
            }
            if (!isset($tag)){
                $tag='td';
            }
            if (!isset($bgcolor)){
                $bgcolor='white';
            }



            //            print_r($cellData);
            echo "<".$tag." bgcolor='".$bgcolor."' colspan='".$colspan."' rowspan='".$rowspan."' >".$value."</".$tag.">";
        }

    }