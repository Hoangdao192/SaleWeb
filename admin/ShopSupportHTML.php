<?php
    include_once "Product.php";
    //  This file take data from database and return it in HTML

    $product = new Product;

    if (isset($_GET['id'])) {
        $categoryId = $_GET['id'];
        $allResult = $product->show_product_by_category($categoryId);
        showDataToHTML($allResult);
        exit();
    }

    if (isset($_GET['productTypeId'])) {
        $productTypeId = $_GET['productTypeId'];
        $result = $product->show_product_by_type($productTypeId);
        showDataToHTML($result);
        exit();
    }

    //  Show data in HTML
    //  Data is mysqli querry result
    function showDataToHTML($data) {
        if ($data) {
            $j = 0;
            while ($result = $data->fetch_assoc()) {
                $j++;
                $divProductItemStyle = "";
                if (fmod($j,3) != 0 || $j == 0) {
                    $divProductItemStyle = "margin-right:4.7%";
                }

                echo    "<div style=\"" . $divProductItemStyle . "\"class=\"product-item\">";
                echo        "<img src=\"admin/database/" . $result['productImagePath'] . "\">";
                echo        "<div class=\"product-color\">";

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
                    echo            "<input type=\"radio\" class=\"radio\" name=\"" . $radioButtonName . "\" " . $radioChecked . " id=\"" . $radioButtonId . "\">";
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
                echo        "<button class=\"add-to-cart\" onclick=\"addToCart(" . $result['productId'] . ")\">";
                echo            "<i class=\"fa-xl fa-thin fa-plus\"></i>";
                echo            "<div class=\"product-size-sub-menu\">";
                echo                "<p>S</p>";
                echo                "<p>M</p>";
                echo                "<p>L</p>";
                echo                "<p>XL</p>";
                echo                "<p>XXL</p>";
                echo            "</div>";
                echo        "</button>";
                echo    "</div>";
            }
        }
    }
