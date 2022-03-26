<?php
    include_once "ShoppingCart.php";

    session_start();
    $shoppingCart = new ShopingCart;

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $productId = $_POST['productId'];
        $shoppingCart->insert_product($productId);
    } else {
        echo $_SERVER['REQUEST_METHOD'];
    } 
?>