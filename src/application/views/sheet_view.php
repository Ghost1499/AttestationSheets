<div id="attestation-sheet-header">
    <h1>Свод оценок рубежных аттестаций за октябрь - декабрь 2019 г. студентов 3 курса направления
        "Информационные системы"
    </h1>
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

        });
    </script>
</div>
