<?php


    class Generator_sheet_menu
    {
        public function __construct($data)
        {
            $this->selectionNames=[];
            array_push($this->selectionNames,'studiyng_year','semester_number','spec_code','group_number','att_number');
            $this->options=[];
            foreach ($this->selectionNames as $item)
            {
                $arr=array_unique(array_column($data, $item));
                natsort($arr);
                $this->options[$item] =   $arr;
                //var_dump(array_unique(array_column($data, $item)));
            }
            $this->formName="sheet";
            $this->fromAction="sheets";
            $this->formParams=[];
            array_push( $this->formParams,['name'=>"studiyng_year",'sectionLabelText'=>'Год обучения','optgroupParams'=>['label'=>'Выберите год обучения','firstOption'=>'Все года']]);
            array_push( $this->formParams,['name'=>"semester_number",'sectionLabelText'=>'Номер семестра','optgroupParams'=>['label'=>'Выберите номер семестра','firstOption'=>'Все семестры']]);
            array_push( $this->formParams,['name'=>"spec_code",'sectionLabelText'=>'Специальность','optgroupParams'=>['label'=>'Выберите специальность','firstOption'=>'Все специальности']]);
            array_push( $this->formParams,['name'=>"group_number",'sectionLabelText'=>'Группа','optgroupParams'=>['label'=>'Выберите группу','firstOption'=>'Все группы']]);
            array_push( $this->formParams,['name'=>"att_number",'sectionLabelText'=>'Аттестация','optgroupParams'=>['label'=>'Выберите аттестацию','firstOption'=>'Все аттестации']]);
            for($i=0;$i<count($this->options);$i++){
                $this->addOptionsList($i);
            }
           /* var_dump($this->options);
            var_dump($this->formParams);*/
        }
        private function addOptionsList($number){
            $this->formParams[$number]['optgroupParams']['options']=$this->options[$this->formParams[$number]['name']];
        }
        public function GenerateSheetMenu(){
            $this->printForm($this->formName,$this->fromAction,$this->formParams);
        }
        private function printForm($name,$formAction,$formParams){
            if(!$name or empty($formAction) or !is_array($formParams)){
                throw new Exception("Form error");
            }
            $formId=$name."-form";
            echo "<form id=\"".$formId."\" action=\"".$formAction."\">";
            foreach ( $formParams as $key=>$value)
            {
                try
                {
                    extract($value);
                }
                catch (Exception $ex){
                    throw new Exception("Form error");
                }
                $this->printSection($name, $sectionLabelText, $optgroupParams);
            }
            echo "<input type=\"submit\" value=\"Отправить\" />";

        }
        private function printSection($name, $sectionLabelText, $optgroupParams){
            if(!$name or !$sectionLabelText){
                throw new Exception('Section error');
            }
            $sectionName=$name.'-section';
            echo "<section class=\"row\"
                 id=\"".$sectionName."\">
                <label for=\"".$sectionName."\">".$sectionLabelText.": </label>";
            $this->printSelection($optgroupParams, $name);
            echo "</section>";
        }
        /**
         * @param array $optgroupParams
         * @param string $selectionId
         * @throws Exception
         */
        private function printSelection($optgroupParams, $name)
        {
            //var_dump($optgroupParams,$name);
            if(!$name or !is_array($optgroupParams)){
                throw new Exception("Selection error");
            }
            $selectionId=$name."-selection";
            echo "<select
                    id=\"".$selectionId."\"
                    name=\"".$name."\">";
            /*foreach ( $optgroupParams as $key=>$value)
            {
                try
                {
                    extract($value);
                    //var_dump($label,$firstOption,$options);
                }
                catch (Exception $ex){
                    throw new Exception("Selection error");
                }
                $this->printOptgroup($label, $firstOption, $options);
            }*/
            extract($optgroupParams);
            $this->printOptgroup($label, $firstOption, $options);
            echo "</select>";
        }

        /**
         * @param string $label
         */
        private function printOptgroup($label, $firstOption, $options)
        {
            if (!$label or !$firstOption or !is_array($options))
            {
                //var_dump($label,$firstOption,$options);
                throw new Exception("Optgroup error");
            }
            echo "<optgroup label='" . $label . "'>
                <option value='all'>" . $firstOption . "</option>";
            foreach ($options as $key => $value)
            {
                $this->printOption($value);
            }

            echo "</optgroup>";
        }

        private function printOption($value)
        {
            echo '<option>' . $value . '</option>';
        }
    }