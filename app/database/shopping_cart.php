<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/product_table.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/views/product_big.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/customer_table.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/order_table.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/models/order.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/order_detail_table.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/models/order_detail.php";

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == 'delete') {
        delete_item($_GET['index']);
    } 
    else if ($action == 'order') {
        create_order();
    }
    else if ($action == 'load') {
        load_cart();
    }
}

function load_cart() {
    if (session_status() === PHP_SESSION_NONE) {
    session_start();
    }
    $products = $_SESSION['cart'];
    $product_table = new ProductTable;
    for ($i = 0; $i < sizeof($products); ++$i) {
        $product_id = $products[$i][0];
        $product = $product_table->get_product($product_id);
        product_cart($product, $products[$i]);
    }
}

function delete_item($index) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $products = $_SESSION['cart'];
    array_splice($products, $index, 1);
    $_SESSION['cart'] = $products;
}

function count_item() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $products = $_SESSION['cart'];
    return sizeof($products);
}

function create_order() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (sizeof($_SESSION['cart']) == 0) return;

    $customer_id = -1;
    if (isset($_SESSION['customerId'])) {
        $customer_id = $_SESSION['customerId'];
    } else {
        $customer_table = new CustomerTable();
        $_SESSION['customerId'] = $customer_table->last_insert_id();
        $customer_id = $_SESSION['customerId'];
    }

    $new_order = new Order();
    $new_order->customer_number = $customer_id;
    $new_order->order_date = date("Y-m-d");
    $new_order->total_price = get_total_price();

    $order_table = new OrderTable();
    $order_table->insert($new_order);

    $order_number = $order_table->last_insert_id();
    //  Add order detail
    $products = $_SESSION['cart'];
    $product_table = new ProductTable;
    $order_detail_table = new OrderDetailTable();
    for ($i = 0; $i < sizeof($products); ++$i) {
        $product_id = $products[$i][0];
        $product = $product_table->get_product($product_id);

        $new_order_detail = new OrderDetail();
        $new_order_detail->order_number = $order_number;
        $new_order_detail->product_id = $products[$i][0];
        $new_order_detail->product_size = $products[$i][1];
        $new_order_detail->product_color = $products[$i][2];
        $new_order_detail->quantity_ordered = $products[$i][3];
        $new_order_detail->price_each = $product->price;
        $order_detail_table->insert($new_order_detail);
    }

    $_SESSION['cart'] = [];
    
}

function get_total_price() {
    $products = $_SESSION['cart'];
    $product_table = new ProductTable;
    $total_price = 0;
    for ($i = 0; $i < sizeof($products); ++$i) {
        $product_id = $products[$i][0];
        $product = $product_table->get_product($product_id);
        $total_price += intval($product->price) * intval($products[$i][3]);
    }
    return $total_price;
}

?>
