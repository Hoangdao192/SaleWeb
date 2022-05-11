<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/ProductTable.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/views/product_big.php";

$productTable = new ProductTable;
$products = $productTable->getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a914f93d25.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/product.css">
    <link rel="shortcut icon" href="images/favicon.png" type="images/x-icon">
    <title>B.C.D</title>
</head>

<body>
    <!-- Header start -->
    <?php
    include "common/header.php"
    ?>
    <!-- Header end -->

    <!-------------------------Poster----------------------------------------------------------------------->
    <section id="Slider">
        <div class="aspect-ratio-169">
            <img src="images/hero/hero-1.jpg">
            <img src="images/hero/hero-2.jpg">
            <div class="hero-text">
                <h6>BỘ SƯU TẬP MÙA HÈ</h6>
                <h2>BỘ SƯU TẬP <br> MÙA ĐÔNG 2022</h2>
                <p>Phong cách là một phương thức để nói lên bạn là ai mà không khiến bạn tốn một lời.</p>
                <a class="Slider__button" href="shop">MUA NGAY<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                <div class="Slider__toolkit">
                    <a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    <a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a>
                    <a href=""><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                    <a href=""><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>

        <div class="dot-container">
            <div class="dot active"></div>
            <div class="dot"></div>
        </div>
    </section>

    <!-------------------------Banner----------------------------------------------------------------------->
    <section class="banner">
        <div class="banner-item">
            <div class="banner-item__first">
                <div class="banner-item-pic">
                    <img src="images/banner/banner-1.jpg" alt="Banner 1">
                </div>
                <div class="banner-item-title">
                    <p>Bộ Sưu Tập <br> 2022</p>
                    <a href="shop">MUA NGAY</a>
                </div>
            </div>
        </div>
        <div class="banner-item">
            <div class="banner-item__middle">
                <div class="banner-item-pic">
                    <img src="images/banner/banner-2.jpg" alt="Banner 2">
                </div>
                <div class="banner-item-title">
                    <p>Phụ kiện</p>
                    <a href="shop?category_id=6">MUA NGAY</a>
                </div>
            </div>
        </div>
        <div class="banner-item">
            <div class="banner-item__last">
                <div class="banner-item-pic">
                    <img src="images/banner/banner-3.jpg" alt="Banner 3">
                </div>
                <div class="banner-item-title">
                    <p>Đồ nữ <br> 2022</p>
                    <a href="shop?category_id=2">MUA NGAY</a>
                </div>
            </div>
        </div>
    </section>

    <!-------------------------Product----------------------------------------------------------------------->
    <section class="product">
        <div class="option-product">
            <li id="best-sellers">Bán chạy nhất</li>
            <li id="new-arrivals">Hàng mới về</li>
            <li id="hot-sales">Giảm giá</li>
        </div>
        <div class="product-content">
            <div id="product-content-best-seller">
                <?php
                $j = 0;
                for ($i = 0; $i < sizeof($products); ++$i) {
                    if ($i > 7) break;
                    product_big($products[$i]);
                }
                ?>
            </div>
            <div id="product-content-new-product">
            <?php
                $j = 0;
                for ($i = sizeof($products) - 1; $i >= 0; $i = $i - 1) {
                    if ($i <= sizeof($products) - 9) break;
                    product_big($products[$i]);
                }
                ?>
            </div>
            <div id="product-content-hot-sales">
            <?php
                $j = 0;
                for ($i = 0; $i < sizeof($products); ++$i) {
                    if ($i > 7) break;
                    product_big($products[$i]);  
                }
                ?>
            </div>
        </div>
    </section>

    <!-------------------------Sale Product----------------------------------------------------------------------->

    <section class="sale-product">
        <div class="sale-product__category-text">
            <li>Hot</li>
            <li>Bộ sưu tập Giày</li>
            <li>Phụ kiện</li>
        </div>
        <div class="sale-product-item">
            <img src="images/product-sale.png" alt="Product Sale">
        </div>
        <div class="sale-product__category-deal-countdown">
            <p>NỔI BẬT</p><br>
            <p>Túi xách nhiều ngăn</p><br>
            <div class="sale-product__category-deal-countdown__time">
                <span id="dd">00</span> : <span id="hh">00</span> : <span id="mm">00</span> : <span id="ss">00</span>
            </div>
            <a href="shop">MUA NGAY</a>
        </div>
    </section>

    <!-------------------------Instagram----------------------------------------------------------------------->

    <section class="instagram">
        <div class="instagram-picture">
            <img src="images/instagram/instagram-1.jpg" alt="Instagram picture 1">
            <img src="images/instagram/instagram-2.jpg" alt="Instagram picture 2">
            <img src="images/instagram/instagram-3.jpg" alt="Instagram picture 3">
            <img src="images/instagram/instagram-4.jpg" alt="Instagram picture 4">
            <img src="images/instagram/instagram-5.jpg" alt="Instagram picture 5">
            <img src="images/instagram/instagram-6.jpg" alt="Instagram picture 6">
        </div>
        <div class="instagram-text">
            <h2>Instagram</h2>
            <h3>#Male_Fashion</h3>
        </div>
    </section>

    <!-------------------------New Trends----------------------------------------------------------------------->

    <section class="new-trends">
        <div class="new-trends-title">
            <span>THÔNG TIN MỚI NHẤT</span>
            <h2>Xu hướng thời trang</h2>
        </div>
        <div class="new-trends-list">
            <div class="new-trends-list__item">
                <img src="images/blog/blog-1.jpg" alt="blog 1">
                <div class="new-trends-list__item-text">
                    <span>
                        <img src="images/icon/calendar.png" alt=""> 16 Tháng Hai 2022
                    </span>
                    <h5>Hãng thời trang nào đang được ưa chuộng nhất</h5>
                    <a href="#">ĐỌC THÊM</a>
                </div>
            </div>
            <div class="new-trends-list__item">
                <img src="images/blog/blog-2.jpg" alt="blog 2">
                <div class="new-trends-list__item-text">
                    <span>
                        <img src="images/icon/calendar.png" alt=""> 21 Tháng Hai 2022
                    </span>
                    <h5>Thời trang năng động</h5>
                    <a href="#">ĐỌC THÊM</a>
                </div>
            </div>
            <div class="new-trends-list__item">
                <img src="images/blog/blog-3.jpg" alt="blog 3">
                <div class="new-trends-list__item-text">
                    <span>
                        <img src="images/icon/calendar.png" alt=""> 6 Tháng Hai 2022
                    </span>
                    <h5>Lợi ích của việc đeo kính râm</h5>
                    <a href="#">ĐỌC THÊM</a>
                </div>
            </div>
        </div>
    </section>

    <?php
    include "common/footer.php"
    ?>
</body>
<script src="javascript/index.js"></script>
</html>