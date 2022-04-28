<?php
    include_once "ShoppingCart.php";

    session_start();
    $shoppingCart = new ShopingCart;

    echo json_encode($_SESSION['cart']);
    
?>