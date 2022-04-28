<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/74e2dc450b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/product-cart.css">
    <link rel="stylesheet" href="css/font.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <title>TEAM BCD - Male faction</title>
</head>

<body>
    <!-----------------------------------Header------------------------------------------------------------>
    <?php 
    include "common/header.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/product_table.php";
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    ?>
        
    <!-------------------------Content----------------------------------------------------------------------->
    <div class="container">
        <div class="row">
            <div class="container-left">
                <div class="order-payment">
                    <ul>
                        <li>Giỏ hàng</li>
                        <li>Đặt hàng</li>
                        <li>Thanh toán</li>
                        <li>Hoàn thành đơn</li>
                    </ul>
                </div>
                <div class="product-list">
                    <div class="product-list-tilte">
                        <p>Giỏ hàng của bạn <span><?php echo sizeof($_SESSION['cart'])?></span> <span>Sản Phẩm</span></p>
                    </div>
                    <div class="product-list-content">
                        <table>
                            <tr class="head">
                                <th>TÊN SẢN PHẨM</th>
                                <th>MÀU SẮC</th>
                                <th>SỐ LƯỢNG</th>
                                <th>TỔNG TIỀN</th>
                            </tr>
                            <?php
                            $products = $_SESSION['cart'];
                            $product_table = new ProductTable;
                            for ($i = 0; $i < sizeof($products); ++$i) {
                                $product_id = $products[$i][0];
                                $product_color = $products[$i][2];
                                $product_size = $products[$i][1];
                                $product_quantity = $products[$i][3];

                                $product = $product_table->get_product($product_id);
                            ?>
                            <tr class="content-item">
                                <td>
                                    <div><img src="admin/database/<?php echo $product->image_path?>" alt=""></div>
                                    <div class="content-detail">
                                        <input style="display: none;" class="product_price" value="<?php echo $product->price?>">
                                        <p class="name-product"><?php echo $product->name?></p>
                                        <p class="size">Size: <span><?php echo $product_size?></span></p>
                                    </div>
                                </td>
                                <td>
                                    <div class="color_container">
                                        <div style="background-color: <?php echo $product_color?>;" class="product_color"></div>
                                    </div>                                    
                                </td>
                                <td>
                                    <div class="detail-product__quantity">
                                        <div class="number">
                                            <div class="number-increase">+</div>
                                            <input readonly type="number" value="<?php echo $product_quantity?>" min="1" max="10" name="quantity">
                                            <div class="number-decrease">-</div>
                                        </div>
                                        <div class="tip-quantity">xx</div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <p><span class="product_total_money"><?php echo number_format(intval($product->price) * intval($product_quantity), 0, ',', '.')?></span><sup>đ</sup></p>
                                        <p><i class="fa fa-trash-o" aria-hidden="true"></i></p>
                                    </div>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                    <div><a href="shop.php">Tiếp tục mua hàng</a></div>
                </div>
            </div>
            <div class="container-right">
                <div class="cart-summary">
                    <h3>Tổng tiền giỏ hàng</h3>
                    <div>
                        <p><span class="total_product">Tổng sản phẩm</span></p><span><?php echo sizeof($_SESSION['cart'])?></span></div>
                    <div>
                        <p>Tổng tiền hàng </p>
                        <p><span class="total_money">1.770.000</span><sup>đ</sup></p>
                    </div>
                </div>
                <div class="order_field">
                    <p class="order_button">ĐẶT HÀNG</p>
                </div>
            </div>
        </div>
    </div>

    <!-------------------------Footer----------------------------------------------------------------------->
    <?php
    include "common/footer.php"
    ?>
</body>

<script src="javascript/cart.js"></script>

</html>