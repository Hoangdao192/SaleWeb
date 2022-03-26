<?php
    include_once "ShoppingCart.php";

    session_start();
    $shoppingCart = new ShopingCart;

    var_dump($GLOBALS);
    if (isset($_POST['productId'])) {
        $productId = $_POST['productId'];
        $shoppingCart->insert_product($productId);
    } else {
        echo "ERROR";
    }
?>