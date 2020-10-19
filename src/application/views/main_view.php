<div id="sheet-menu">
    <?php
        $generator_sheet_menu=new Generator_sheet_menu($sheets_menu_data,$selectionNames);
        $generator_sheet_menu->GenerateSheetMenu(); ?>

</div>
<div id="sheet-list">
    <?php
        $generator_sheets_list=new Generator_sheets_list($selectionNames);
        $generator_sheets_list->GenerateSheetList($sheets_data);
    ?>
    <div class="sheet shadowed padding btn"
         onclick="document.location='sheet_page.html'"
    >
        <h1>Аттестация Программирование</h1>
        <p>3 курс 2 группа 2019 год</p>
    </div>
    <div class="sheet shadowed padding btn">
        <h1>Аттестация 3 курс "Исит"</h1>
        <p>6 семестр 2 группа 2019 год</p>
    </div>
</div>
