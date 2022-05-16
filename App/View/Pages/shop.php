<?php

use Core\HTML;

$categories = $data["categories"];
$categoryId = $data['categoryId'];
$productTypes = $data['productTypes'];
?>

<script type="text/javascript">
    $(document).ready(function() {
        const menuHome = document.querySelector(".menu__shop");
        menuHome.classList.add("menu__item__underline");
        showProductByCategory();
    });

    function showProductByCategory() {
        $.ajax({
            type: 'post',
            url: 'http://localhost/saleweb/ajax/shop/show_product_by_category',
            data: {
                categoryId: <?php echo $categoryId ?>
            },
            success: function(response) {
                var contentRight = document.querySelectorAll(".content-right-content")[0];
                contentRight.innerHTML = response;
                showPage(1);
            }
        });
    }

    function showProductByType() {
        var productTypeSelector = document.getElementById("product-type");
        var productTypeId = productTypeSelector.options[productTypeSelector.selectedIndex].value;
        if (productTypeId == -1) {
            showProductByCategory();
            return;
        }
        $.ajax({
            type: 'post',
            url: 'http://localhost/saleweb/ajax/shop/show_product_by_type',
            data: {
                productTypeId: productTypeId,
                page: 1
            },
            success: function(response) {
                var contentRight = document.querySelectorAll(".content-right-content")[0];
                contentRight.innerHTML = response;
                showPage(1);
            }
        });
    }

    function addToCart(productId, productSize, colorRadioGroupId, colorArray) {
        console.log(productId);

        //  Get selected color
        var radioGroup = document.getElementById(colorRadioGroupId);
        console.log(radioGroup);
        var radioArray = radioGroup.querySelectorAll(".radio");
        console.log(radioArray);
        var productColor;
        for (let i = 0; i < radioArray.length; i++) {
            if (radioArray[i].checked) {
                productColor = radioArray[i].value;
            }
        }

        console.log(productId + " " + productSize + " " + productColor);
        $.ajax({
            type: 'post',
            url: 'http://localhost/saleweb/ajax/shopingcart/add',
            data: {
                action: 'add',
                productId: productId,
                productSize: productSize,
                productColor: productColor,
                productQuantity: 1
            },
            success: function(response) {
                var decodeJSON = JSON.parse(response);
                console.log(decodeJSON);
                // Success!
                if (decodeJSON.status == "success") {
                    document.getElementById("cart-product-number").innerHTML = decodeJSON.numberOfItem;
                    toast({
                        title: "Đã thêm vào giỏ hàng",
                        message:  ""
                    });
                } else {
                    var message = decodeJSON.message;
                    toast({
                        title: message,
                        message:  ""
                    });
                }
            }
        });
    }

    function showProductDetail(productId) {
        console.log("clicked");
        window.location.href = "./product.php?productId=" + productId;
    }

    function searchProduct() {
        var productTypeSelector = document.getElementById("product-type");
        var searchBox = document.getElementById("search-box");

        var productTypeId = productTypeSelector.options[productTypeSelector.selectedIndex].value;
        var target = searchBox.value;
        $.ajax({
            type: 'get',
            url: 'app/database/product_search.php',
            data: {
                productTypeId: productTypeId,
                categoryId: <?php echo $categoryId ?>,
                targetName: target,
                page: 1
            },
            success: function(response) {
                console.log("search called");
                var contentRight = document.querySelectorAll(".content-right-content")[0];
                contentRight.innerHTML = response;
                showPage(1);
            }
        });
    }
</script>

<link rel="stylesheet" href="<?php echo HTML::style("font.css") ?>">
<link rel="stylesheet" href="<?php echo HTML::style("product.css") ?>">
<link rel="stylesheet" href="<?php echo HTML::style("shop.css") ?>">
<section class="directory">
    <h1>Cửa hàng</h1>
    <p>Trang chủ &nbsp;<span></span>&nbsp; Cửa hàng</p>
</section>
<!----------------------Content------------------------->
<section class="content">
    <div class="content-left">
        <div class="search-box">
            <input id="search-box" type="text" placeholder="Tìm kiếm">
            <i onclick="searchProduct()" id="search-button" class="fa-solid fa-magnifying-glass"></i>
        </div>
        <div class="categories">
            <h1>DANH MỤC</h1><i class="show-categories fa-solid fa-chevron-down"></i>
            <div class="categories-sub-menu">
                <?php
                for ($i = 0; $i < sizeof($categories); ++$i) {
                    $category = $categories[$i];
                ?>
                    <input style="display: none;" type="number" name="categoryId" value="<?php echo $category->id ?>">
                    <br>
                    <a style="<?php if ($categoryId == $category->id) echo "color:black" ?>" href="http://localhost/saleweb/shop/categoryId/<?php echo $category->id ?>">
                        <?php echo $category->name ?>
                    </a>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="content-right">
        <div class="content-right-head">
            <select name="product-type" id="product-type" onchange="showProductByType()">
                <option value="-1">Hiển thị tất cả</option>
                <?php
                //  Get all product type from database and show it to selector
                for ($i = 0; $i < sizeof($productTypes); ++$i) {
                    $productType = $productTypes[$i];
                ?>
                    <option value="<?php echo $productType->id ?>"><?php echo $productType->name ?></option>
                <?php
                }
                ?>
            </select>
            <div class="content-right-head-sort">
                <!-- <p>Sắp xếp: </p>
                    <select name="sort-type" id="sort-type">
                        <option value="low-to-high">Giá thấp đến cao</option>
                        <option value="high-to-low">Giá cao đến thấp</option>
                        <option value="a-to-z">A đến Z</option>
                        <option value="z-to-a">Z đến A</option>
                    </select> -->
            </div>
        </div>
        <div class="content-right-content">
            <!--------------------Content will be add by ajax------------------->
        </div>
        <div class="content-right-bottom">
            <p id="page-navigator" current-page="1" max-page="1">
                <i onclick="previousPage()" id="previous" class="fa-solid fa-angle-left"></i>
                <span id="page-number">1</span>
                <i onclick="nextPage()" id="next" class="fa-solid fa-angle-right"></i>
            </p>
        </div>
    </div>
</section>
<script src="<?php echo HTML::script("shop.js")?>"></script>
<script>
    function previousPage() {
        var currentPage = parseInt(document.getElementById("page-navigator").getAttribute("current-page"));
        if (currentPage == 1) return;
        currentPage -= 1;
        document.getElementById("page-navigator").setAttribute("current-page", currentPage);
        showPage(currentPage);
    }

    function nextPage() {
        var currentPage = parseInt(document.getElementById("page-navigator").getAttribute("current-page"));
        var maxPage = parseInt(document.getElementById("page-navigator").getAttribute("max-page"));
        if (currentPage == maxPage) return;
        currentPage += 1;
        document.getElementById("page-navigator").setAttribute("current-page", currentPage);
        showPage(currentPage);
    }

    function showPage(pageNumber) {
        document.getElementById("page-number").innerHTML = pageNumber;

        var products = document.querySelectorAll(".product-item");
        document.getElementById("page-navigator").setAttribute("max-page", Math.floor(products.length / 9) + (products.length % 9 == 0 ? 0 : 1));
        for (let i = 0; i < products.length; ++i) {
            if (i >= (pageNumber - 1) * 9 && i < (pageNumber - 1) * 9 + 9) {
                products[i].style.display = "flex";
            } else {
                products[i].style.display = "none";
            }
        }
    }
</script>