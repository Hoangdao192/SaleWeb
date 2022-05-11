<?php 
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/ProductTypeTable.php";

    $productTypeTable = new ProductTypeTable;

    if (!isset($_GET[ProductTypeTable::$COL_PRODUCT_TYPE_ID]) || $_GET[ProductTypeTable::$COL_PRODUCT_TYPE_ID] == NULL) {
        echo "<script>window.location = 'listproduct.php'</script>";
    } else {
        $productTypeId = $_GET[ProductTypeTable::$COL_PRODUCT_TYPE_ID];
    }
    $productTypeTable->deleteProductType($productTypeId);
    header('Location:show_product_type.php');
?>