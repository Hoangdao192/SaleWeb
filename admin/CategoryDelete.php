<?php 
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/category_table.php";

    $category_table = new CategoryTable;
    if (!isset($_GET[CategoryTable::$COLUMN_CATEGORY_ID]) || $_GET[CategoryTable::$COLUMN_CATEGORY_ID] == NULL) {
        //echo "<script>window.location = 'listproduct.php'</script>";
    } else {
        $category_id = $_GET[CategoryTable::$COLUMN_CATEGORY_ID];
        $category_table->delete_category($category_id);
    }
    header('Location:CategoryList.php');
?>