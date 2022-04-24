<?php
    include_once "ShoppingCart.php";

    session_start();
    $shoppingCart = new ShopingCart;

    $action = $_POST['action'];

    if ($action == 'add') {
        $productId = $_POST['productId'];
        $productSize = $_POST['productSize'];
        $productColor = $_POST['productColor'];
        $productQuantity = $_POST['productQuantity'];
        $shoppingCart->addToCart($productId, $productSize, $productColor, $productQuantity);
        echo count($_SESSION['cart']);
        exit();
    }

    if ($action == 'count') {
        //echo $shoppingCart->countInCart();
        echo count($_SESSION['cart']);
        exit();
    }
    
?>