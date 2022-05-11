<?php 
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/ProductTable.php";

    $productTable = new ProductTable;
    if (!isset($_GET[ProductTable::$COL_PRODUCT_ID]) || $_GET[ProductTable::$COL_PRODUCT_ID] == NULL) {
        echo "<script>window.location = 'listproduct.php'</script>";
    } else {
        $productId = $_GET[ProductTable::$COL_PRODUCT_ID];
    }
    $productTable->deleteProduct($productId);
    header('Location:show_product.php');
?>