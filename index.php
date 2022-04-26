<?php
include_once "app/database/product_table.php";

$product_table = new ProductTable;
$products = $product_table->get_all();
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
        function addToCart(productId, productSize, colorradio_group_id, colorArray) {
            console.log(productId);

            //  Get selected color
            var radioGroup = document.getElementById(colorradio_group_id);
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
                    window.location.href = "./product?productId=" + productId;
        }
    </script>
</head>

<body>
    <?php
    include "common/header.php"
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
                for ($i = 0; $i < sizeof($products); ++$i) {
                    if ($i > 7) break;
                    $product = $products[$i];
                    $j++;
                    $divProductItemStyle = "";
                    $radio_group_id = "product-color" . $product->id;
                    if (fmod($j, 4) != 0 || $j == 0) {
                        $divProductItemStyle = "margin-right:10px";
                    }
                ?>
                <div class="product-item">
                    <img onclick="showProductDetail(<?php echo $product->id?>)" src="admin/database/<?php echo $product->image_path?>">
                    <div id="<?php echo $radio_group_id?>" class="product-color">
                    <?php
                    $color_array = $product->color;
                    for ($j = 0; $j < sizeof($color_array); $j++) {
                        $radio_button_name = "2color" . $product->id;
                        $radio_button_id = "2color" . $product->id . "-" . $j;
                        $radio_checked = "";
                        if ($j == 0) {
                            $radio_checked = "checked";
                        }
                    ?>
                        <div class="product-color-item">
                            <input value="<?php echo $color_array[$j]?>" type="radio" 
                                class="radio" name="<?php echo $radio_button_name?>" <?php echo $radio_checked?>  
                                id="<?php echo $radio_button_id?>">
                            <label style="background-color: <?php echo $color_array[$j]?>" for="<?php echo $radio_button_id?>" class="radio-label">
                                <i class="fa-xs fa-solid fa-check"></i>
                            </label>
                        </div>
                    <?php
                    }
                    ?>
                    </div>
                    <p class="product-name"><?php echo $product->name?></p>
                    <p class="product-price"><?php echo number_format($product->price, 0, ',', '.')?><span>đ</span></p>
                    <input style="display: none;" type="text" name="insert" value="insert"/>
                    <input style="display: none;" class="product-id-input" name="productId" value="<?php echo $product->id?>"/>
                    <button class="add-to-cart">
                        <i class="fa-xl fa-thin fa-plus"></i>
                        <div class="product-size-sub-menu">
                            <p onClick="addToCart(<?php echo $product->id?>,'S','<?php echo $radio_group_id?>')">S</p>
                            <p onClick="addToCart(<?php echo $product->id?>,'S','<?php echo $radio_group_id?>')">M</p>
                            <p onClick="addToCart(<?php echo $product->id?>,'S','<?php echo $radio_group_id?>')">L</p>
                            <p onClick="addToCart(<?php echo $product->id?>,'S','<?php echo $radio_group_id?>')">XL</p>
                            <p onClick="addToCart(<?php echo $product->id?>,'S','<?php echo $radio_group_id?>')">XXL</p>
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
                for ($i = sizeof($products) - 1; $i >= 0; $i = $i - 1) {
                    echo $i;
                    if ($i < sizeof($products) - 7) break;
                    $product = $products[$i];
                    $j++;
                    $divProductItemStyle = "";
                    $radio_group_id = "product-color" . $product->id;
                    if (fmod($j, 4) != 0 || $j == 0) {
                        $divProductItemStyle = "margin-right:10px";
                    }
                ?>
                <div class="product-item">
                    <img onclick="showProductDetail(<?php echo $product->id?>)" src="admin/database/<?php echo $product->image_path?>">
                    <div id="<?php echo $radio_group_id?>" class="product-color">
                    <?php
                    $color_array = $product->color;
                    for ($j = 0; $j < sizeof($color_array); $j++) {
                        $radio_button_name = "color" . $product->id;
                        $radio_button_id = "color" . $product->id . "-" . $j;
                        $radio_checked = "";
                        if ($j == 0) {
                            $radio_checked = "checked";
                        }
                    ?>
                        <div class="product-color-item">
                            <input value="<?php echo $color_array[$j]?>" type="radio" 
                                class="radio" name="<?php echo $radio_button_name?>" <?php echo $radio_checked?>  
                                id="<?php echo $radio_button_id?>">
                            <label style="background-color: <?php echo $color_array[$j]?>" for="<?php echo $radio_button_id?>" class="radio-label">
                                <i class="fa-xs fa-solid fa-check"></i>
                            </label>
                        </div>
                    <?php
                        }
                    ?>
                    </div>
                    <p class="product-name"><?php echo $product->name?></p>
                    <p class="product-price"><?php echo number_format($product->price, 0, ',', '.')?><span>đ</span></p>
                    <input style="display: none;" type="text" name="insert" value="insert"/>
                    <input style="display: none;" class="product-id-input" name="productId" value="<?php echo $product->id?>"/>
                    <button class="add-to-cart">
                        <i class="fa-xl fa-thin fa-plus"></i>
                        <div class="product-size-sub-menu">
                            <p onClick="addToCart(<?php echo $product->id?>,'S','<?php echo $radio_group_id?>')">S</p>
                            <p onClick="addToCart(<?php echo $product->id?>,'S','<?php echo $radio_group_id?>')">M</p>
                            <p onClick="addToCart(<?php echo $product->id?>,'S','<?php echo $radio_group_id?>')">L</p>
                            <p onClick="addToCart(<?php echo $product->id?>,'S','<?php echo $radio_group_id?>')">XL</p>
                            <p onClick="addToCart(<?php echo $product->id?>,'S','<?php echo $radio_group_id?>')">XXL</p>
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
                for ($i = 0; $i < sizeof($products); ++$i) {
                    if ($i > 7) break;
                    $product = $products[$i];
                    $j++;
                    $divProductItemStyle = "";
                    $radio_group_id = "product-color" . $product->id;
                    if (fmod($j, 4) != 0 || $j == 0) {
                        $divProductItemStyle = "margin-right:10px";
                    }
                ?>
                <div class="product-item">
                    <img onclick="showProductDetail(<?php echo $product->id?>)" src="admin/database/<?php echo $product->image_path?>">
                    <div id="<?php echo $radio_group_id?>" class="product-color">
                    <?php
                    $color_array = $product->color;
                    for ($j = 0; $j < sizeof($color_array); $j++) {
                        $radio_button_name = "1color" . $product->id;
                        $radio_button_id = "1color" . $product->id . "-" . $j;
                        $radio_checked = "";
                        if ($j == 0) {
                            $radio_checked = "checked";
                        }
                    ?>
                        <div class="product-color-item">
                            <input value="<?php echo $color_array[$j]?>" type="radio" 
                                class="radio" name="<?php echo $radio_button_name?>" <?php echo $radio_checked?>  
                                id="<?php echo $radio_button_id?>">
                            <label style="background-color: <?php echo $color_array[$j]?>" for="<?php echo $radio_button_id?>" class="radio-label">
                                <i class="fa-xs fa-solid fa-check"></i>
                            </label>
                        </div>
                    <?php
                    }
                    ?>
                    </div>
                    <p class="product-name"><?php echo $product->name?></p>
                    <p class="product-price"><?php echo number_format($product->price, 0, ',', '.')?><span>đ</span></p>
                    <input style="display: none;" type="text" name="insert" value="insert"/>
                    <input style="display: none;" class="product-id-input" name="productId" value="<?php echo $product->id?>"/>
                    <button class="add-to-cart">
                        <i class="fa-xl fa-thin fa-plus"></i>
                        <div class="product-size-sub-menu">
                            <p onClick="addToCart(<?php echo $product->id?>,'S','<?php echo $radio_group_id?>')">S</p>
                            <p onClick="addToCart(<?php echo $product->id?>,'S','<?php echo $radio_group_id?>')">M</p>
                            <p onClick="addToCart(<?php echo $product->id?>,'S','<?php echo $radio_group_id?>')">L</p>
                            <p onClick="addToCart(<?php echo $product->id?>,'S','<?php echo $radio_group_id?>')">XL</p>
                            <p onClick="addToCart(<?php echo $product->id?>,'S','<?php echo $radio_group_id?>')">XXL</p>
                        </div>
                    </button>
                </div>
                <?php
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
            <p> Sale Of <span>$29.99</span></p>
        </div>
        <div class="sale-product__category-deal-countdown">
            <p>DEAL OF WEEK</p><br>
            <p>Multi-pocket Chest Bag Black</p><br>
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
    include "common/footer.php"
    ?>
</body>
<script src="javascript/index.js"></script>

</html>