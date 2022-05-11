<?php
include_once "app/database/Query.php";
include_once "app/database/order_table.php";
include_once "app/database/customer_table.php";
include_once "app/database/UserTable.php";
include_once "app/models/order.php";

$query = new Query;
$contentArray = [];
$contentArray["first"] = "1";
$contentArray["second"] = 2;
$contentArray["third"] = 3;
$query->update("Test", $contentArray, "first = 1");
echo $query->build();