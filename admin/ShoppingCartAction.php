<?php
    include_once "ShoppingCart.php";

    session_start();
    $shoppingCart = new ShopingCart;

    $action = $_POST['action'];

    if ($action == 'add') {
        $productId = $_POST['productId'];
        $shoppingCart->addToCart($productId);
        echo ($_SESSION);
        exit();
    }

    if ($action == 'count') {
        //echo $shoppingCart->countInCart();
        echo count($_SESSION['cart']);
        exit();
    }
    
?>