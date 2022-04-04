<?php
include_once "admin/Product.php";

$product = new Product;
$showProduct = $product->show_product_limit(0, 8);
$showNewProduct = $product->show_new_product_limit(0, 8);
$hotSaleProduct = $product->show_product_limit(0,8);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a914f93d25.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/product.css">
    <title>TEAM BCD - Male faction</title>
    <script>
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
        });
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
                    productColor: productColor
                },
                success: function(response) {
                    document.getElementById("cart-product-number").innerHTML = response;
                }
            });
        }
    </script>
</head>

<body>
    <?php
    include "php/header.php"
    ?>

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
                    <a href="#">MUA NGAY</a>
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
                    <a href="#">MUA NGAY</a>
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
                    <a href="#">MUA NGAY</a>
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
            <div id="product-content-best-seller">
                <?php
                $j = 0;
                while ($result = $showProduct->fetch_assoc()) {
                    $j++;
                    $divProductItemStyle = "";
                    $radioGroupId = "product-color" . $result['productId'];
                    if (fmod($j, 4) != 0 || $j == 0) {
                        $divProductItemStyle = "margin-right:10px";
                    }
                ?>
                <div class="product-item">
                    <img src="admin/database/<?php echo $result['productImagePath']?>">
                    <div id="<?php echo $radioGroupId?>" class="product-color">
                    <?php
                    $colorArray = $result['productColor'];
                    $splitRegex = "/,/";
                    $splitResult = preg_split($splitRegex, $colorArray);
                    for ($i = 0; $i < sizeof($splitResult); $i++) {
                        $radioButtonName = "2color" . $result['productId'];
                        $radioButtonId = "2color" . $result['productId'] . "-" . $i;
                        $radioChecked = "";
                        if ($i == 0) {
                            $radioChecked = "checked";
                        }
                    ?>
                        <div class="product-color-item">
                            <input value="<?php echo $splitResult[$i]?>" type="radio" class="radio" name="<?php echo $radioButtonName?>" <?php echo $radioChecked?>  id="<?php echo $radioButtonId?>">
                                <label style="background-color: <?php echo $splitResult[$i]?>" for="<?php echo $radioButtonId?>" class="radio-label">
                                    <i class="fa-xs fa-solid fa-check"></i>
                                </label>
                        </div>
                    <?php
                        }
                    ?>
                    </div>
                    <p class="product-name"><?php echo $result['productName']?></p>
                    <p class="product-price"><?php echo number_format($result['productPrice'], 0, ',', '.')?><span>đ</span></p>
                    <input style="display: none;" type="text" name="insert" value="insert"/>
                    <input style="display: none;" class="product-id-input" name="productId" value="<?php echo $result['productId']?>"/>
                    <button class="add-to-cart">
                        <i class="fa-xl fa-thin fa-plus"></i>
                        <div class="product-size-sub-menu">
                            <p onClick="addToCart(<?php echo $result['productId']?>,'S','<?php echo $radioGroupId?>')">S</p>
                            <p onClick="addToCart(<?php echo $result['productId']?>,'S','<?php echo $radioGroupId?>')">M</p>
                            <p onClick="addToCart(<?php echo $result['productId']?>,'S','<?php echo $radioGroupId?>')">L</p>
                            <p onClick="addToCart(<?php echo $result['productId']?>,'S','<?php echo $radioGroupId?>')">XL</p>
                            <p onClick="addToCart(<?php echo $result['productId']?>,'S','<?php echo $radioGroupId?>')">XXL</p>
                        </div>
                    </button>
                </div>
                <?php
                    }
                ?>
            </div>
            <div id="product-content-new-product">
                <?php
                $j = 0;
                while ($result = $showNewProduct->fetch_assoc()) {
                    $j++;
                    $divProductItemStyle = "";
                    $radioGroupId = "product-color" . $result['productId'];
                    if (fmod($j, 4) != 0 || $j == 0) {
                        $divProductItemStyle = "margin-right:10px";
                    }
                ?>
                <div class="product-item">
                    <img src="admin/database/<?php echo $result['productImagePath']?>">
                    <div id="<?php echo $radioGroupId?>" class="product-color">
                    <?php
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
                    ?>
                        <div class="product-color-item">
                            <input value="<?php echo $splitResult[$i]?>" type="radio" class="radio" name="<?php echo $radioButtonName?>" <?php echo $radioChecked?>  id="<?php echo $radioButtonId?>">
                                <label style="background-color: <?php echo $splitResult[$i]?>" for="<?php echo $radioButtonId?>" class="radio-label">
                                    <i class="fa-xs fa-solid fa-check"></i>
                                </label>
                        </div>
                    <?php
                        }
                    ?>
                    </div>
                    <p class="product-name"><?php echo $result['productName']?></p>
                    <p class="product-price"><?php echo number_format($result['productPrice'], 0, ',', '.')?><span>đ</span></p>
                    <input style="display: none;" type="text" name="insert" value="insert"/>
                    <input style="display: none;" class="product-id-input" name="productId" value="<?php echo $result['productId']?>"/>
                    <button class="add-to-cart">
                        <i class="fa-xl fa-thin fa-plus"></i>
                        <div class="product-size-sub-menu">
                            <p onClick="addToCart(<?php echo $result['productId']?>,'S','<?php echo $radioGroupId?>')">S</p>
                            <p onClick="addToCart(<?php echo $result['productId']?>,'S','<?php echo $radioGroupId?>')">M</p>
                            <p onClick="addToCart(<?php echo $result['productId']?>,'S','<?php echo $radioGroupId?>')">L</p>
                            <p onClick="addToCart(<?php echo $result['productId']?>,'S','<?php echo $radioGroupId?>')">XL</p>
                            <p onClick="addToCart(<?php echo $result['productId']?>,'S','<?php echo $radioGroupId?>')">XXL</p>
                        </div>
                    </button>
                </div>
                <?php
                    }
                ?>
            </div>
            <div id="product-content-hot-sales">
                <?php
                $j = 0;
                while ($result = $hotSaleProduct->fetch_assoc()) {
                    $j++;
                    $divProductItemStyle = "";
                    $radioGroupId = "product-color" . $result['productId'];
                    if (fmod($j, 4) != 0 || $j == 0) {
                        $divProductItemStyle = "margin-right:10px";
                    }
                ?>
                <div class="product-item">
                    <img src="admin/database/<?php echo $result['productImagePath']?>">
                    <div id="<?php echo $radioGroupId?>" class="product-color">
                    <?php
                    $colorArray = $result['productColor'];
                    $splitRegex = "/,/";
                    $splitResult = preg_split($splitRegex, $colorArray);
                    for ($i = 0; $i < sizeof($splitResult); $i++) {
                        $radioButtonName = "3color" . $result['productId'];
                        $radioButtonId = "3color" . $result['productId'] . "-" . $i;
                        $radioChecked = "";
                        if ($i == 0) {
                            $radioChecked = "checked";
                        }
                    ?>
                        <div class="product-color-item">
                            <input value="<?php echo $splitResult[$i]?>" type="radio" class="radio" name="<?php echo $radioButtonName?>" <?php echo $radioChecked?>  id="<?php echo $radioButtonId?>">
                                <label style="background-color: <?php echo $splitResult[$i]?>" for="<?php echo $radioButtonId?>" class="radio-label">
                                    <i class="fa-xs fa-solid fa-check"></i>
                                </label>
                        </div>
                    <?php
                        }
                    ?>
                    </div>
                    <p class="product-name"><?php echo $result['productName']?></p>
                    <p class="product-price"><?php echo number_format($result['productPrice'], 0, ',', '.')?><span>đ</span></p>
                    <input style="display: none;" type="text" name="insert" value="insert"/>
                    <input style="display: none;" class="product-id-input" name="productId" value="<?php echo $result['productId']?>"/>
                    <button class="add-to-cart">
                        <i class="fa-xl fa-thin fa-plus"></i>
                        <div class="product-size-sub-menu">
                            <p onClick="addToCart(<?php echo $result['productId']?>,'S','<?php echo $radioGroupId?>')">S</p>
                            <p onClick="addToCart(<?php echo $result['productId']?>,'S','<?php echo $radioGroupId?>')">M</p>
                            <p onClick="addToCart(<?php echo $result['productId']?>,'S','<?php echo $radioGroupId?>')">L</p>
                            <p onClick="addToCart(<?php echo $result['productId']?>,'S','<?php echo $radioGroupId?>')">XL</p>
                            <p onClick="addToCart(<?php echo $result['productId']?>,'S','<?php echo $radioGroupId?>')">XXL</p>
                        </div>
                    </button>
                </div>
                <?php
                    }
                ?>
            </div>
            <!-- new-arr; hot-sale -->
            <!-- 
            <div class="product-item new-arr">
                <img src="images/product/product-1.jpg">
                <div class="product-item__toolhover">
                    <li>
                        <a href=""><img src="images/icon/heart.png" alt=""></a>
                    </li>
                    <li>
                        <a href=""><img src="images/icon/compare.png" alt=""></a>
                    </li>
                    <li>
                        <a href=""><img src="images/icon/search.png" alt=""></a>
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
                <img src="images/product/product-2.jpg">
                <div class="product-item__toolhover">
                    <li>
                        <a href=""><img src="images/icon/heart.png" alt=""></a>
                    </li>
                    <li>
                        <a href=""><img src="images/icon/compare.png" alt=""></a>
                    </li>
                    <li>
                        <a href=""><img src="images/icon/search.png" alt=""></a>
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
                <img src="images/product/product-3.jpg">
                <div class="product-item__toolhover">
                    <li>
                        <a href=""><img src="images/icon/heart.png" alt=""></a>
                    </li>
                    <li>
                        <a href=""><img src="images/icon/compare.png" alt=""></a>
                    </li>
                    <li>
                        <a href=""><img src="images/icon/search.png" alt=""></a>
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
                <img src="images/product/product-4.jpg">
                <div class="product-item__toolhover">
                    <li>
                        <a href=""><img src="images/icon/heart.png" alt=""></a>
                    </li>
                    <li>
                        <a href=""><img src="images/icon/compare.png" alt=""></a>
                    </li>
                    <li>
                        <a href=""><img src="images/icon/search.png" alt=""></a>
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
                <img src="images/product/product-5.jpg">
                <div class="product-item__toolhover">
                    <li>
                        <a href=""><img src="images/icon/heart.png" alt=""></a>
                    </li>
                    <li>
                        <a href=""><img src="images/icon/compare.png" alt=""></a>
                    </li>
                    <li>
                        <a href=""><img src="images/icon/search.png" alt=""></a>
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
                <img src="images/product/product-6.jpg">
                <div class="product-item__toolhover">
                    <li>
                        <a href=""><img src="images/icon/heart.png" alt=""></a>
                    </li>
                    <li>
                        <a href=""><img src="images/icon/compare.png" alt=""></a>
                    </li>
                    <li>
                        <a href=""><img src="images/icon/search.png" alt=""></a>
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
                <img src="images/product/product-7.jpg">
                <div class="product-item__toolhover">
                    <li>
                        <a href=""><img src="images/icon/heart.png" alt=""></a>
                    </li>
                    <li>
                        <a href=""><img src="images/icon/compare.png" alt=""></a>
                    </li>
                    <li>
                        <a href=""><img src="images/icon/search.png" alt=""></a>
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
                <img src="images/product/product-8.jpg">
                <div class="product-item__toolhover">
                    <li>
                        <a href=""><img src="images/icon/heart.png" alt=""></a>
                    </li>
                    <li>
                        <a href=""><img src="images/icon/compare.png" alt=""></a>
                    </li>
                    <li>
                        <a href=""><img src="images/icon/search.png" alt=""></a>
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
            </div> -->
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
            <img src="images/product-sale.png" alt="Product Sale">
            <p> Sale Of <span>$29.99</span></p>
        </div>
        <div class="sale-product__category-deal-countdown">
            <p>DEAL OF WEEK</p><br>
            <p>Multi-pocket Chest Bag Black</p><br>
            <div class="sale-product__category-deal-countdown__time">
                <span id="dd">00</span> : <span id="hh">00</span> : <span id="mm">00</span> : <span id="ss">00</span>
            </div>
            <a href="shop">SHOP NOW</a>
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
                <img src="images/blog/blog-1.jpg" alt="blog 1">
                <div class="new-trends-list__item-text">
                    <span>
                        <img src="images/icon/calendar.png" alt=""> 16 February 2022
                    </span>
                    <h5>What Culling Irons Are The Best Ones</h5>
                    <a href="#">READ MORE</a>
                </div>
            </div>
            <div class="new-trends-list__item">
                <img src="images/blog/blog-2.jpg" alt="blog 2">
                <div class="new-trends-list__item-text">
                    <span>
                        <img src="images/icon/calendar.png" alt=""> 21 February 2022
                    </span>
                    <h5>Eternity Bands Do Last Forever</h5>
                    <a href="#">READ MORE</a>
                </div>
            </div>
            <div class="new-trends-list__item">
                <img src="images/blog/blog-3.jpg" alt="blog 3">
                <div class="new-trends-list__item-text">
                    <span>
                        <img src="images/icon/calendar.png" alt=""> 28 February 2022
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
<script src="javascript/index.js"></script>

</html>