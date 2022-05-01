<?php
include_once "app/database/query.php";

$querry = new Query();
$querry->get_all('product')->filter_by("categoryId = 1")->order_by("productId");

echo $querry->build();