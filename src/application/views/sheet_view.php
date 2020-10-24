<div id="attestation-sheet-header" class="w3-card-4 w3-round-xxlarge w3-pale-yellow">
    <?php
            echo "<h1>Свод оценок рубежных аттестаций за ".$semester_number." семестр ".$studiyng_year." г. студентов ".$course_number." курса направления ".$speciality_code." ".$speciality_name." ".$group_number." группа <h1>";
            ?>
<!--    <h1>Свод оценок рубежных аттестаций за октябрь - декабрь 2019 г. студентов 3 курса направления-->
<!--        "Информационные системы"-->
<!--    </h1>-->
</div>
<div id="attestation-sheet">
    <?php
        $generatorSheetTable=new Generator_sheet_table();
        $generatorSheetTable->GenerateTable($subjects,$student_rows);
    ?>
<!--    <table id="attestation-table"
           class="display-center">
        <thead>
        <tr>
            <td>Номер</td>
            <td >ФИО</td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>1</td>
            <td>Баженов</td>
            <td>13</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Бакулин</td>
            <td>25</td>
            <td>24</td>
        </tr>
        </tbody>
    </table>-->

    <script>
        $(document).ready(function () {
            $('#attestation-table').colorize();
            // alert('done');
        });
    </script>
</div>
