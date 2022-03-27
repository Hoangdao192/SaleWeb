<?php
    include_once "Product.php";
    //  This file take data from database and return it in HTML

    $product = new Product;

    if (isset($_GET['id'])) {
        $categoryId = $_GET['id'];
        $allResult = $product->show_product_by_category($categoryId);
        showDataToHTML($allResult, 1);
        exit();
    }

    if (isset($_GET['productTypeId'])) {
        $productTypeId = $_GET['productTypeId'];
        $page = $_GET['page'];
        $result = $product->show_product_by_type($productTypeId);
        showDataToHTML($result, $page);
        exit();
    }

    //  Show data in HTML
    //  Data is mysqli querry result
    function showDataToHTML($data, $page) {
        if ($data) {
            $j = ($page - 1) * 12;
            while ($result = $data->fetch_assoc()) {
                $j++;
                if ($j > 12) break;
                $divProductItemStyle = "";
                $radioGroupId = "product-color" . $result['productId'];
                if (fmod($j,3) != 0 || $j == 0) {
                    $divProductItemStyle = "margin-right:4.7%";
                }

                echo    "<div style=\"" . $divProductItemStyle . "\"class=\"product-item\">";
                echo        "<img src=\"admin/database/" . $result['productImagePath'] . "\">";
                echo        "<div id=\"" . $radioGroupId . "\" class=\"product-color\">";

                $colorArray = $result['productColor'];
                $splitRegex = "/,/";
                $splitResult = preg_split($splitRegex, $colorArray);

                for ($i = 0; $i < sizeof($splitResult); $i++) {
                    $radioButtonName = "color" . $result['productId'];
                    $radioButtonId = "color" . $result['productId'] . "-" . $i;
                    $radioChecked = "";
                    if ($i == 0) {
                        $radioChecked = "checked";
                    }
                    echo        "<div class=\"product-color-item\">";
                    echo            "<input value=\"" . $splitResult[$i] . "\" type=\"radio\" class=\"radio\" name=\"" . $radioButtonName . "\" " . $radioChecked . " id=\"" . $radioButtonId . "\">";
                    echo                "<label style=\"background-color:" . $splitResult[$i] . "\" for=\"" . $radioButtonId . "\" class=\"radio-label\">";
                    echo                    "<i class=\"fa-xs fa-solid fa-check\"></i>";
                    echo                "</label>";
                    echo        "</div>";
                }
                            
                echo        "</div>";
                echo        "<p class=\"product-name\">" . $result['productName'] . "</p>";
                echo        "<p class=\"product-price\">" . number_format($result['productPrice'], 0, ',', '.') . "<span>đ</span></p>";
                echo        "<input style=\"display: none;\" type=\"text\" name=\"insert\" value=\"insert\"/>";
                echo        "<input style=\"display: none;\" class=\"product-id-input\" name=\"productId\" value=\"" . $result['productId'] . "\" />";
                echo        "<button class=\"add-to-cart\">";
                echo            "<i class=\"fa-xl fa-thin fa-plus\"></i>";
                echo            "<div class=\"product-size-sub-menu\">";
                echo                "<p onClick=\"addToCart(" . $result['productId'] . ",'S','" . $radioGroupId . "')\">S</p>";
                echo                "<p onClick=\"addToCart(" . $result['productId'] . ",'M','" . $radioGroupId . "')\">M</p>";
                echo                "<p onClick=\"addToCart(" . $result['productId'] . ",'L','" . $radioGroupId . "')\">L</p>";
                echo                "<p onClick=\"addToCart(" . $result['productId'] . ",'XL','" . $radioGroupId . "')\">XL</p>";
                echo                "<p onClick=\"addToCart(" . $result['productId'] . ",'XXL','" . $radioGroupId . "')\">XXL</p>";
                echo            "</div>";
                echo        "</button>";
                echo    "</div>";
            }
        }
    }
