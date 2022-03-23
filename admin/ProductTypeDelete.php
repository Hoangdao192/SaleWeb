<?php 
    include_once "ProductType.php";

    $productType = new ProductType;
    if (!isset($_GET['id_loaisanpham']) || $_GET['id_loaisanpham'] == NULL) {
        echo "<script>window.location = 'listproduct.php'</script>";
    } else {
        $productTypeId = $_GET['id_loaisanpham'];
    }
    $productType->delete_product_type($productTypeId);
    header('Location:ProductTypeList.php');
?>