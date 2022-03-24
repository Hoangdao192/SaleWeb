<?php 
include_once "Category.php";

    $category = new Category;
    if (!isset($_GET[$category->COLUMN_CATEGORY_ID]) || $_GET[$category->COLUMN_CATEGORY_ID] == NULL) {
        //echo "<script>window.location = 'listproduct.php'</script>";
    } else {
        $categoryId = $_GET[$category->COLUMN_CATEGORY_ID];
        $category->delete_category($categoryId);
    }
    header('Location:CategoryList.php');
?>