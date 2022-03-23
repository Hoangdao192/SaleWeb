<?php 
include_once "Category.php";

    $category = new Category;
    if (!isset($_GET['id_danhmuc']) || $_GET['id_danhmuc'] == NULL) {
        //echo "<script>window.location = 'listproduct.php'</script>";
    } else {
        $categoryId = $_GET['id_danhmuc'];
        $category->delete_category($categoryId);
    }
    header('Location:CategoryList.php');
?>