<?php
use Core\HTML;
use App\View;

$products = $data["products"];
?>
<link rel="stylesheet" href="<?php echo HTML::style("index.css")?>">
<link rel="stylesheet" href="<?php echo HTML::style("product.css")?>">

<!-------------------------Poster----------------------------------------------------------------------->
<section id="Slider">
    <div class="aspect-ratio-169">
        <img src="<?php echo HTML::image("hero/hero-1.jpg")?>">
        <img src="<?php echo HTML::image("hero/hero-2.jpg")?>">
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
                <img src="<?php echo HTML::image("banner/banner-1.jpg")?>" alt="Banner 1">
            </div>
            <div class="banner-item-title">
                <p>Bộ Sưu Tập <br> 2022</p>
                <a href="http://localhost/saleweb/shop">MUA NGAY</a>
            </div>
        </div>
    </div>
    <div class="banner-item">
        <div class="banner-item__middle">
            <div class="banner-item-pic">
                <img src="<?php echo HTML::image("banner/banner-2.jpg")?>" alt="Banner 2">
            </div>
            <div class="banner-item-title">
                <p>Phụ kiện</p>
                <a href="http://localhost/saleweb/shop/category/6">MUA NGAY</a>
            </div>
        </div>
    </div>
    <div class="banner-item">
        <div class="banner-item__last">
            <div class="banner-item-pic">
                <img src="<?php echo HTML::image("banner/banner-3.jpg")?>" alt="Banner 3">
            </div>
            <div class="banner-item-title">
                <p>Đồ nữ <br> 2022</p>
                <a href="http://localhost/saleweb/shop/category/2">MUA NGAY</a>
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
                View::render('Product.product_thumbnail', ["product" => $products[$i]]);
            }
            ?>
        </div>
        <div id="product-content-new-product">
            <?php
            $j = 0;
            for ($i = sizeof($products) - 1; $i >= 0; $i = $i - 1) {
                if ($i <= sizeof($products) - 9) break;
                View::render('Product.product_thumbnail', ["product" => $products[$i]]);
            }
            ?>
        </div>
        <div id="product-content-hot-sales">
            <?php
            $j = 0;
            for ($i = 0; $i < sizeof($products); ++$i) {
                if ($i > 7) break;
                View::render('Product.product_thumbnail', ["product" => $products[$i]]);
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
        <img src="<?php echo HTML::image("product-sale.png")?>" alt="Product Sale">
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
        <img src="<?php echo HTML::image("instagram/instagram-1.jpg")?>" alt="Instagram picture 1">
        <img src="<?php echo HTML::image("instagram/instagram-2.jpg")?>" alt="Instagram picture 2">
        <img src="<?php echo HTML::image("instagram/instagram-3.jpg")?>" alt="Instagram picture 3">
        <img src="<?php echo HTML::image("instagram/instagram-4.jpg")?>" alt="Instagram picture 4">
        <img src="<?php echo HTML::image("instagram/instagram-5.jpg")?>" alt="Instagram picture 5">
        <img src="<?php echo HTML::image("instagram/instagram-6.jpg")?>" alt="Instagram picture 6">
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
            <img src="<?php echo HTML::image("blog/blog-1.jpg")?>" alt="blog 1">
            <div class="new-trends-list__item-text">
                <span>
                    <img src="<?php echo HTML::image("icon/calendar.png")?>" alt=""> 16 Tháng Hai 2022
                </span>
                <h5>Hãng thời trang nào đang được ưa chuộng nhất</h5>
                <a href="#">ĐỌC THÊM</a>
            </div>
        </div>
        <div class="new-trends-list__item">
            <img src="<?php echo HTML::image("blog/blog-2.jpg")?>" alt="blog 2">
            <div class="new-trends-list__item-text">
                <span>
                    <img src="<?php echo HTML::image("icon/calendar.png")?>" alt=""> 21 Tháng Hai 2022
                </span>
                <h5>Thời trang năng động</h5>
                <a href="#">ĐỌC THÊM</a>
            </div>
        </div>
        <div class="new-trends-list__item">
            <img src="<?php echo HTML::image("blog/blog-3.jpg")?>" alt="blog 3">
            <div class="new-trends-list__item-text">
                <span>
                    <img src="<?php echo HTML::image("icon/calendar.png")?>" alt=""> 6 Tháng Hai 2022
                </span>
                <h5>Lợi ích của việc đeo kính râm</h5>
                <a href="#">ĐỌC THÊM</a>
            </div>
        </div>
    </div>
</section>

<script src="<?php echo HTML::script("index.js")?>"></script>