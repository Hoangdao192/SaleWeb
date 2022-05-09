<?php
include_once "app/database/query.php";
include_once "app/database/order_table.php";
include_once "app/database/customer_table.php";
include_once "app/database/UserTable.php";
include_once "app/models/order.php";

$userTable = new UserTable();
echo $userTable->lastInsertId();