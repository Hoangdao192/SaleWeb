<?php
include_once "admin/Product.php";
include_once "admin/ShoppingCart.php";

$product = new product;
$product_show = $product->show_product();
$shoppingCart = new ShopingCart;
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
    <link rel="stylesheet" href="css/shop.css">
    <link rel="stylesheet" href="css/font.css">
    <title>SHOP</title>
</head>

<body>
    <section class="header">
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
            <li>
                <a href="#"><img src="images/icon/search.png"></a>
            </li>
            <li>
                <a href="#"><img src="images/icon/heart.png"></a>
            </li>
            <li class="quantity">
                <a href="#"><img src="images/icon/cart.png"><span>0</span></a>
            </li>
            <li class="price">$0.00</li>
        </div>
    </section>
    <section class="directory">
        <h1>Shop</h1>
        <p>Home &nbsp;<span></span>&nbsp; Shop</p>
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
                    <br><a href="">Nam</a><br>
                    <a href="">Nữ</a><br>
                    <a href="">Phụ kiện</a>
                </div>
            </div>
        </div>
        <div class="content-right">
            <div class="content-right-head">
                <p>Sắp xếp: </p>
                <select name="sort-type" id="sort-type">
                    <option value="low-to-high">Giá thấp đến cao</option>
                    <option value="high-to-low">Giá cao đến thấp</option>
                    <option value="a-to-z">A đến Z</option>
                    <option value="z-to-a">Z đến A</option>
                </select>
            </div>
            <div class="content-right-content">
                <?php
                if ($product_show) {
                    $i = 0;
                    while ($result = $product_show->fetch_assoc()) {
                ?>
                    <div class="product-item">
                        <var></var>
                        <img src="admin/database/<?php echo $result['productImagePath'] ?>">
                        <div class="product-color">
                            <div class="product-color-item"></div>
                        </div>
                        <p class="product-name"><?php echo $result['productName'] ?></p>
                        <p class="product-price"><?php echo $result['productPrice'] ?><span>đ</span></p>
                        <form action="admin/ShoppingCartAction.php" method="POST">
                            <button class="add-to-cart"><i class="fa-xl fa-thin fa-plus"></i></button>
                            
                        </form>
                    </div>
                <?php
                    }
                }
                ?>
            </div>
            <div class="content-right-bottom">
                <p><span>1</span><span>2</span><span>3</span></p>
            </div>
        </div>
    </section>
    <!---------------------FOOTER------------------------->
    <footer class="footer">
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
    </footer>
</body>
<script src="javascript/shop.js"></script>
<script>
    const buttonAddToCart = document.querySelectorAll(".add-to-cart");
    for (let i = 0; i < buttonAddToCart; i++) {
        buttonAddToCart[i].addEventListener("click", function() {

        });
    }
</script>

</html>