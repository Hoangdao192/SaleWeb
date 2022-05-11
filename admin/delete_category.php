<?php 
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/CategoryTable.php";

    $categoryTable = new CategoryTable;
    if (!isset($_GET[CategoryTable::$COL_CATEGORY_ID]) || $_GET[CategoryTable::$COL_CATEGORY_ID] == NULL) {
        //echo "<script>window.location = 'listproduct.php'</script>";
    } else {
        $categoryId = $_GET[CategoryTable::$COL_CATEGORY_ID];
        $categoryTable->deleteCategory($categoryId);
    }
    header('Location:show_category.php');
?>