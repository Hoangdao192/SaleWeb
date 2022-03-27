<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/74e2dc450b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/footer.css">
    <title>TEAM BCD - Male faction</title>
</head>

<body>
    <!-----------------------------------Header------------------------------------------------------------>
    <!-- <header>
        -------------------Headertop------------------------------------------------
        <div class="headertop">
            <div>
                <h1>TEAM BCD</h1>
            </div>
            <div class="toolsupport">
                <li><a href="">SIGN IN</a></li>
                <li><a href="">FAQS</a></li>
                <div class="unitmoney"><a class="unitmoney" href="">USD</a>
                    <span class="selectunitmoney">&#8964;</span>
                    <ul class="selectunit">
                        <li><a href="">USD</a></li>
                        <li><a href="">EUR</a></li>
                    </ul>
                </div>
            </div>
        </div>
        -------------------Headerbottom---------------------------------------------
        <div class="headerbottom">
            <div class="logo">
                <a href=""><img src="/images/logo.png"></a>
            </div>
            <div class="menu">
                <li><a href="index.html">Home</a></li>
                <li><a href="shop.html">Shop</a></li>
                <li><a href="">Pages</a>
                    <ul class="dropdown">
                        <li><a href="">About Us</a></li>
                        <li><a href="">Shop Details</a></li>
                        <li><a href="">Shopping Cart</a></li>
                        <li><a href="">Check out</a></li>
                        <li><a href="">Blog Details</a></li>
                    </ul>
                </li>
                <li><a href="blog.html">Blog</a></li>
                <li><a href="">Contacts</a></li>
            </div>
            -------------------Orther------------------------------------------------
            <div class="orther">
                <li>
                    <a href="#"><img src="/images/icon/search.png"></a>
                </li>
                <li>
                    <a href="#"><img src="/images/icon/heart.png"></a>
                </li>
                <li class="quantity">
                    <p class="quantity__product">0</p><img src="/images/icon/cart.png">
                </li>
                <div class="price">$0.00</div>
            </div>
        </div>
    </header> -->

    <?php 
    include "php/header.php"
    ?>

    <!-------------------------Poster----------------------------------------------------------------------->
    <section id="Slider">
        <div class="aspect-ratio-169">
            <img src="/images/hero/hero-1.jpg">
            <img src="/images/hero/hero-2.jpg">
            <div class="hero-text">
                <h6>SUMMER COLLECTION</h6>
                <h2>Fall - Winter Collections 2030</h2>
                <p>A specialist label creating luxury essentials. Ethically crafted with an un wavering commitment to exceptional quality.</p>
                <a class="Slider__button" href="">SHOP NOW<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
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
                    <img src="/images/banner/banner-1.jpg" alt="Banner 1">
                </div>
                <div class="banner-item-title">
                    <p>Clothing Colections 2030</p>
                    <a href="#">SHOP NOW</a>
                </div>
            </div>
        </div>
        <div class="banner-item">
            <div class="banner-item__middle">
                <div class="banner-item-pic">
                    <img src="/images/banner/banner-2.jpg" alt="Banner 2">
                </div>
                <div class="banner-item-title">
                    <p>Accessories</p>
                    <a href="#">SHOP NOW</a>
                </div>
            </div>
        </div>
        <div class="banner-item">
            <div class="banner-item__last">
                <div class="banner-item-pic">
                    <img src="/images/banner/banner-3.jpg" alt="Banner 3">
                </div>
                <div class="banner-item-title">
                    <p>Shoes Spring 2030</p>
                    <a href="#">SHOP NOW</a>
                </div>
            </div>
        </div>
    </section>

    <!-------------------------Product----------------------------------------------------------------------->

    <section class="product">
        <div class="option-product">
            <li id="best-sellers">Best Sellers</li>
            <li id="new-arrivals">New Arrivals</li>
            <li id="hot-sales">Hot Sales</li>
        </div>
        <div class="product-content">
            <!-- new-arr; hot-sale -->
            <div class="product-item new-arr">
                <img src="/images/product/product-1.jpg">
                <div class="product-item__toolhover">
                    <li>
                        <a href=""><img src="/images/icon/heart.png" alt=""></a>
                    </li>
                    <li>
                        <a href=""><img src="/images/icon/compare.png" alt=""></a>
                    </li>
                    <li>
                        <a href=""><img src="/images/icon/search.png" alt=""></a>
                    </li>
                </div>
                <div class="product-item__text">
                    <a href="">+Add To Cart</a>
                    <div>
                        <label class="label__blue"><input type="radio" class="input"></label>
                        <label class="label__black"><input type="radio" class="input"></label>
                        <label class="label__gray"><input type="radio" class="input"></label>
                    </div>
                    <h6>Piqué Biker Jacket</h6>
                    <span></span>
                    <p>$67.24</p>
                </div>
            </div>
            <div class="product-item hot-sale">
                <img src="/images/product/product-2.jpg">
                <div class="product-item__toolhover">
                    <li>
                        <a href=""><img src="/images/icon/heart.png" alt=""></a>
                    </li>
                    <li>
                        <a href=""><img src="/images/icon/compare.png" alt=""></a>
                    </li>
                    <li>
                        <a href=""><img src="/images/icon/search.png" alt=""></a>
                    </li>
                </div>
                <div class="product-item__text">
                    <a href="">+Add To Cart</a>
                    <div>
                        <label class="label__blue"><input type="radio" class="input"></label>
                        <label class="label__black"><input type="radio" class="input"></label>
                        <label class="label__gray"><input type="radio" class="input"></label>
                    </div>
                    <h6>Piqué Biker Jacket</h6>
                    <span></span>
                    <p>$67.24</p>
                </div>
            </div>
            <div class="product-item new-arr">
                <img src="/images/product/product-3.jpg">
                <div class="product-item__toolhover">
                    <li>
                        <a href=""><img src="/images/icon/heart.png" alt=""></a>
                    </li>
                    <li>
                        <a href=""><img src="/images/icon/compare.png" alt=""></a>
                    </li>
                    <li>
                        <a href=""><img src="/images/icon/search.png" alt=""></a>
                    </li>
                </div>
                <div class="product-item__text">
                    <a href="">+Add To Cart</a>
                    <div>
                        <label class="label__blue"><input type="radio" class="input"></label>
                        <label class="label__black"><input type="radio" class="input"></label>
                        <label class="label__gray"><input type="radio" class="input"></label>
                    </div>
                    <h6>Piqué Biker Jacket</h6>
                    <span></span>
                    <p>$67.24</p>
                </div>
            </div>
            <div class="product-item hot-sale">
                <img src="/images/product/product-4.jpg">
                <div class="product-item__toolhover">
                    <li>
                        <a href=""><img src="/images/icon/heart.png" alt=""></a>
                    </li>
                    <li>
                        <a href=""><img src="/images/icon/compare.png" alt=""></a>
                    </li>
                    <li>
                        <a href=""><img src="/images/icon/search.png" alt=""></a>
                    </li>
                </div>
                <div class="product-item__text">
                    <a href="">+Add To Cart</a>
                    <div>
                        <label class="label__blue"><input type="radio" class="input"></label>
                        <label class="label__black"><input type="radio" class="input"></label>
                        <label class="label__gray"><input type="radio" class="input"></label>
                    </div>
                    <h6>Piqué Biker Jacket</h6>
                    <span></span>
                    <p>$67.24</p>
                </div>
            </div>
            <div class="product-item new-arr">
                <img src="/images/product/product-5.jpg">
                <div class="product-item__toolhover">
                    <li>
                        <a href=""><img src="/images/icon/heart.png" alt=""></a>
                    </li>
                    <li>
                        <a href=""><img src="/images/icon/compare.png" alt=""></a>
                    </li>
                    <li>
                        <a href=""><img src="/images/icon/search.png" alt=""></a>
                    </li>
                </div>
                <div class="product-item__text">
                    <a href="">+Add To Cart</a>
                    <div>
                        <label class="label__blue"><input type="radio" class="input"></label>
                        <label class="label__black"><input type="radio" class="input"></label>
                        <label class="label__gray"><input type="radio" class="input"></label>
                    </div>
                    <h6>Piqué Biker Jacket</h6>
                    <span></span>
                    <p>$67.24</p>
                </div>
            </div>
            <div class="product-item hot-sale">
                <img src="/images/product/product-6.jpg">
                <div class="product-item__toolhover">
                    <li>
                        <a href=""><img src="/images/icon/heart.png" alt=""></a>
                    </li>
                    <li>
                        <a href=""><img src="/images/icon/compare.png" alt=""></a>
                    </li>
                    <li>
                        <a href=""><img src="/images/icon/search.png" alt=""></a>
                    </li>
                </div>
                <div class="product-item__text">
                    <a href="">+Add To Cart</a>
                    <div>
                        <label class="label__blue"><input type="radio" class="input"></label>
                        <label class="label__black"><input type="radio" class="input"></label>
                        <label class="label__gray"><input type="radio" class="input"></label>
                    </div>
                    <h6>Piqué Biker Jacket</h6>
                    <span></span>
                    <p>$67.24</p>
                </div>
            </div>
            <div class="product-item new-arr">
                <img src="/images/product/product-7.jpg">
                <div class="product-item__toolhover">
                    <li>
                        <a href=""><img src="/images/icon/heart.png" alt=""></a>
                    </li>
                    <li>
                        <a href=""><img src="/images/icon/compare.png" alt=""></a>
                    </li>
                    <li>
                        <a href=""><img src="/images/icon/search.png" alt=""></a>
                    </li>
                </div>
                <div class="product-item__text">
                    <a href="">+Add To Cart</a>
                    <div>
                        <label class="label__blue"><input type="radio" class="input"></label>
                        <label class="label__black"><input type="radio" class="input"></label>
                        <label class="label__gray"><input type="radio" class="input"></label>
                    </div>
                    <h6>Piqué Biker Jacket</h6>
                    <span></span>
                    <p>$67.24</p>
                </div>
            </div>
            <div class="product-item hot-sale">
                <img src="/images/product/product-8.jpg">
                <div class="product-item__toolhover">
                    <li>
                        <a href=""><img src="/images/icon/heart.png" alt=""></a>
                    </li>
                    <li>
                        <a href=""><img src="/images/icon/compare.png" alt=""></a>
                    </li>
                    <li>
                        <a href=""><img src="/images/icon/search.png" alt=""></a>
                    </li>
                </div>
                <div class="product-item__text">
                    <a href="">+Add To Cart</a>
                    <div>
                        <label class="label__blue"><input type="radio" class="input"></label>
                        <label class="label__black"><input type="radio" class="input"></label>
                        <label class="label__gray"><input type="radio" class="input"></label>
                    </div>
                    <h6>Piqué Biker Jacket</h6>
                    <span></span>
                    <p>$67.24</p>
                </div>
            </div>
        </div>
    </section>

    <!-------------------------Sale Product----------------------------------------------------------------------->

    <section class="sale-product">
        <div class="sale-product__category-text">
            <li>Clothings Hot</li>
            <li>Shoe Colection</li>
            <li>Accessories</li>
        </div>
        <div class="sale-product-item">
            <img src="/images/product-sale.png" alt="Product Sale">
            <p> Sale Of <span>$29.99</span></p>
        </div>
        <div class="sale-product__category-deal-countdown">
            <p>DEAL OF WEEK</p><br>
            <p>Multi-pocket Chest Bag Black</p><br>
            <div class="sale-product__category-deal-countdown__time">
                <span id="dd">00</span> : <span id="hh">00</span> : <span id="mm">00</span> : <span id="ss">00</span>
            </div>
            <a href="#">SHOP NOW</a>
        </div>
    </section>

    <!-------------------------Instagram----------------------------------------------------------------------->

    <section class="instagram">
        <div class="instagram-picture">
            <img src="/images/instagram/instagram-1.jpg" alt="Instagram picture 1">
            <img src="/images/instagram/instagram-2.jpg" alt="Instagram picture 2">
            <img src="/images/instagram/instagram-3.jpg" alt="Instagram picture 3">
            <img src="/images/instagram/instagram-4.jpg" alt="Instagram picture 4">
            <img src="/images/instagram/instagram-5.jpg" alt="Instagram picture 5">
            <img src="/images/instagram/instagram-6.jpg" alt="Instagram picture 6">
        </div>
        <div class="instagram-text">
            <h2>Instagram</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <h3>#Male_Fashion</h3>
        </div>
    </section>

    <!-------------------------New Trends----------------------------------------------------------------------->

    <section class="new-trends">
        <div class="new-trends-title">
            <span>LATEST NEWS</span>
            <h2>Fashion New Trends</h2>
        </div>
        <div class="new-trends-list">
            <div class="new-trends-list__item">
                <img src="/images/blog/blog-1.jpg" alt="blog 1">
                <div class="new-trends-list__item-text">
                    <span>
                        <img src="/images/icon/calendar.png" alt=""> 16 February 2022
                    </span>
                    <h5>What Culling Irons Are The Best Ones</h5>
                    <a href="#">READ MORE</a>
                </div>
            </div>
            <div class="new-trends-list__item">
                <img src="/images/blog/blog-2.jpg" alt="blog 2">
                <div class="new-trends-list__item-text">
                    <span>
                        <img src="/images/icon/calendar.png" alt=""> 21 February 2022
                    </span>
                    <h5>Eternity Bands Do Last Forever</h5>
                    <a href="#">READ MORE</a>
                </div>
            </div>
            <div class="new-trends-list__item">
                <img src="/images/blog/blog-3.jpg" alt="blog 3">
                <div class="new-trends-list__item-text">
                    <span>
                        <img src="/images/icon/calendar.png" alt=""> 28 February 2022
                    </span>
                    <h5>The Health Benefits Of Sunglasses</h5>
                    <a href="#">READ MORE</a>
                </div>
            </div>
        </div>
    </section>

    <?php
    include "php/footer.php"
    ?>
</body>
<script src="/javascript/index.js"></script>
</html>