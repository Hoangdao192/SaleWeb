<?php 
    include_once "Product.php";

    $product = new Product;
    if (!isset($_GET['productId']) || $_GET['productId'] == NULL) {
        echo "<script>window.location = 'listproduct.php'</script>";
    } else {
        $productId = $_GET['productId'];
    }
    $product->delete_product($productId);
    header('Location:ProductList.php');
?>