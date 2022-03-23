<?php 
    include_once "Product.php";

    $product = new Product;
    if (!isset($_GET['id_sanpham']) || $_GET['id_sanpham'] == NULL) {
        echo "<script>window.location = 'listproduct.php'</script>";
    } else {
        $productId = $_GET['id_sanpham'];
    }
    $product->delete_product($productId);
    header('Location:ProductList.php');
?>