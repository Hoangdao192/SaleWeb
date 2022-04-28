<?php 
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/product_type_table.php";

    $product_type_table = new ProductTypeTable;

    if (!isset($_GET[ProductTypeTable::$COLUMN_PRODUCT_TYPE_ID]) || $_GET[ProductTypeTable::$COLUMN_PRODUCT_TYPE_ID] == NULL) {
        echo "<script>window.location = 'listproduct.php'</script>";
    } else {
        $product_type_id = $_GET[ProductTypeTable::$COLUMN_PRODUCT_TYPE_ID];
    }
    $product_type_table->delete_product_type($product_type_id);
    header('Location:show_product_type.php');
?>