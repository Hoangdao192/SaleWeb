<?php 
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/product_table.php";

    $product_table = new ProductTable;
    if (!isset($_GET[ProductTable::$COLUMN_PRODUCT_ID]) || $_GET[ProductTable::$COLUMN_PRODUCT_ID] == NULL) {
        echo "<script>window.location = 'listproduct.php'</script>";
    } else {
        $product_id = $_GET[ProductTable::$COLUMN_PRODUCT_ID];
    }
    $product_table->delete_product($product_id);
    header('Location:show_product.php');
?>