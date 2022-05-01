<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/product_table.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/views/product_big.php";
    //  This file take data from database and return it in HTML

    $product_table = new ProductTable;

    if (isset($_GET['id'])) {
        $categoryId = $_GET['id'];
        $products = $product_table->get_all_filter_by_category($categoryId);
        showDataToHTML($products, 1);
        exit();
    }

    if (isset($_GET['productTypeId'])) {
        $productTypeId = $_GET['productTypeId'];
        $page = $_GET['page'];
        $products = $product_table->get_all_filter_by_type($productTypeId);
        showDataToHTML($products, $page);
        exit();
    }

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
