<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/OrderTable.php";

$orderNumber = $_GET[OrderTable::$COL_ORDER_NUMBER];
$orderTable = new OrderTable();
$orderTable->delete($orderNumber);

header('Location:show_order.php');