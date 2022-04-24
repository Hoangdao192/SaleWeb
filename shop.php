<?php
include_once "admin/Product.php";
include_once "admin/ShoppingCart.php";
include_once "admin/Category.php";
include_once "admin/ProductType.php";

$product = new Product;
$productType = new ProductType;
$category = new Category;
$categoryId = 0;
if (isset($_GET['categoryId'])) {
    $categoryId = $_GET['categoryId'];
} else {
    $allCategory = $category->show_category();
    $firstCategory = $allCategory->fetch_assoc();
    $categoryId = $firstCategory['categoryId'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a914f93d25.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/font.css">
    <link rel="stylesheet" href="css/product.css">
    <link rel="stylesheet" href="css/shop.css">
    <title>SHOP</title>
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajax({
                type: 'post',
                url: 'admin/ShoppingCartAction.php',
                data: {
                    action: 'count'
                },
                success: function(data) {
                    document.getElementById("cart-product-number").innerHTML = data;
                }
            });
            showProductByCategory();
        });

        function showProductByCategory() {
            $.ajax({
                type: 'get',
                url: 'admin/ShopSupportHTML.php',
                data: {
                    id: <?php echo $categoryId ?>
                },
                success: function(response) {
                    var contentRight = document.querySelectorAll(".content-right-content")[0];
                    contentRight.innerHTML = response;
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
                type: 'get',
                url: 'admin/ShopSupportHTML.php',
                data: {
                    productTypeId: productTypeId,
                    page: 1
                },
                success: function(response) {
                    var contentRight = document.querySelectorAll(".content-right-content")[0];
                    contentRight.innerHTML = response;
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
                url: 'admin/ShoppingCartAction.php',
                data: {
                    action: 'add',
                    productId: productId,
                    productSize: productSize,
                    productColor: productColor,
                    productQuantity: 1
                },
                success: function(response) {
                    document.getElementById("cart-product-number").innerHTML = response;
                }
            });
        }

        function showProductDetail(productId) {
            console.log("clicked");
                    window.location.href = "./product_detail.php?productId=" + productId;
        }
    </script>
</head>

<body>
    <?php
    include "php/header.php";
    ?>
    <!-- <section class="header">
        <div class="logo">
            <a href=""><img src="images/logo.png"></a>
        </div>
        <div class="menu">
            <li><a href="index.html">Trang chủ</a></li>
            <li><a href="shop.html">Cửa hàng</a></li>
            <li><a href="#">Blog</a></li>
            <li><a href="#">Liên lạc</a></li>
        </div>
        <div class="other">
            <div>
                <a href="#"><img src="images/icon/search.png"></a>
            </div>
            <div>
                <a href="#"><img src="images/icon/heart.png"></a>
            </div>
            <div class="quantity">
                <a href="#"><img src="images/icon/cart.png"><span id="cart-product-number">10</span></a>
            </div>
            <div class="price">$0.00</div>
        </div>
    </section> -->
    <section class="directory">
        <h1>Cửa hàng</h1>
        <p>Trang chủ &nbsp;<span></span>&nbsp; Cửa hàng</p>
    </section>
    <!----------------------Content------------------------->
    <section class="content">
        <div class="content-left">
            <div class="search-box">
                <input type="text" placeholder="Tìm kiếm">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <div class="categories">
                <h1>DANH MỤC</h1><i class="show-categories fa-solid fa-chevron-down"></i>
                <div class="categories-sub-menu">
                    <?php
                    $showCategory = $category->show_category();
                    while ($result = $showCategory->fetch_assoc()) {
                    ?>
                        <input style="display: none;" type="number" name="categoryId" value="<?php echo $result['categoryId'] ?>">
                        <br>
                        <a style="<?php if ($categoryId == $result['categoryId']) echo "color:black" ?>" href="shop.php?categoryId=<?php echo $result['categoryId'] ?>">
                            <?php echo $result['categoryName'] ?>
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
                    $allProductType = $productType->show_product_type_by_category($categoryId);
                    while ($typeResult = $allProductType->fetch_assoc()) {
                        $productTypeId = $typeResult['productTypeId'];
                        $productTypeName = $typeResult['productTypeName'];
                    ?>
                        <option value="<?php echo $productTypeId ?>"><?php echo $productTypeName ?></option>
                    <?php
                    }
                    ?>
                </select>
                <div class="content-right-head-sort">
                    <p>Sắp xếp: </p>
                    <select name="sort-type" id="sort-type">
                        <option value="low-to-high">Giá thấp đến cao</option>
                        <option value="high-to-low">Giá cao đến thấp</option>
                        <option value="a-to-z">A đến Z</option>
                        <option value="z-to-a">Z đến A</option>
                    </select>
                </div>
            </div>
            <div class="content-right-content">
                <!--------------------Content will be add by ajax------------------->
            </div>
            <div class="content-right-bottom">
                <p><span>1</span><span>2</span><span>3</span></p>
            </div>
        </div>
    </section>
    <!---------------------FOOTER------------------------->
    <?php
    include "php/footer.php"
    ?>
    <!-- <footer class="footer">
        <div class="footer__container">
            <div class="footer__row">
                <div class="footer__about">
                    <div class="footer__logo">
                        <a href=""><img src="images/footer-logo.png" alt=""></a>
                    </div>
                    <p>The customer is at the heart of our unique business model, which includes design.</p>
                    <div class="footer__payment">
                        <a href=""><img src="images/payment.png" </a>
                    </div>
                </div>
                <div class="footer__widget">
                    <b>SHOPPING</b>
                    <ul>
                        <li><a href="">Clothing Store</a></li>
                        <li><a href="">Trending Shoes</a></li>
                        <li><a href="">Accessories</a></li>
                        <li><a href="">Sale</a></li>
                    </ul>
                </div>
                <div class="footer__widget">
                    <b>SHOPPING</b>
                    <ul>
                        <li><a href="">Contact Us</a></li>
                        <li><a href="">Payment Methods</a></li>
                        <li><a href="">Delivary</a></li>
                        <li><a href="">Return & Exchanges</a></li>
                    </ul>
                </div>
                <div class="footer__widget">
                    <b>NEWLETTER</b>
                    <p>Be the first to know about new arrivals. look books, sales & promos!</p>
                    <form action="">
                        <input type="email" placeholder="Your email">
                        <button type="submit"><i class="fa fa-envelope-o" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
            <div class="footer__copyright">
                <p>Copyright © 2022 All rights reserved | This website is made with
                    <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com/">Team BCD</a>
                </p>
            </div>
        </div>
    </footer> -->
</body>
<script src="javascript/shop.js"></script>

</html>