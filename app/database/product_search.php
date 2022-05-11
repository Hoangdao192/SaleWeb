<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/ProductTable.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/views/product_big.php";
    //  This file take data from database and return it in HTML

    $product_table = new ProductTable;

    //if (isset($_GET['productTypeId']) && isset($_GET['categoryId']) && isset($_GET['targetName'])) {
        $categoryId = $_GET['categoryId'];
        $productTypeId = $_GET['productTypeId'];
        $target = $_GET['targetName'];
        $products = $product_table->getAllFilterByName($target, $productTypeId, $categoryId);
        showDataToHTML($products, 1);
        exit();
    //}

    //  Show data in HTML
    //  Data is mysqli querry result
    function showDataToHTML($products, $page) {
        if ($products) {
            $j = ($page - 1) * 12;
            for ($i = 0; $i < sizeof($products); ++$i) {
                product_big($products[$i]);
            }
        }
    }
?>
