<?php
include_once "app/database/query.php";
include_once "app/database/order_table.php";
include_once "app/database/customer_table.php";
include_once "app/models/order.php";

$new_order = new Order();
$new_order->customer_number = 1;
$new_order->order_date = date("Y-m-d");
$new_order->total_price = 1;

$order_table = new OrderTable();
print_r($order_table->get_all());