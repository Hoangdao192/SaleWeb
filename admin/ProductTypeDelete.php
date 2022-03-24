<?php 
    include_once "ProductType.php";

    $productType = new ProductType;
    $columnProductTypeIdTitle = $productType->COLUMN_PRODUCT_TYPE_ID;

    if (!isset($_GET[$columnProductTypeIdTitle]) || $_GET[$columnProductTypeIdTitle] == NULL) {
        echo "<script>window.location = 'listproduct.php'</script>";
    } else {
        $productTypeId = $_GET[$columnProductTypeIdTitle];
    }
    $productType->delete_product_type($productTypeId);
    header('Location:ProductTypeList.php');
?>