<?php
include "header.php";
include "slider.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    echo "Unauthorized";
    exit();
}

// $url = 'Location: ' . $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/customer/show_order.php";
// header($url);
?>