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
    <link rel="shortcut icon" href="images/favicon.png" type="images/x-icon">
    <title>TEAM BCD - Male faction</title>
</head>

<body>
    <!-----------------------------------Header------------------------------------------------------------>
    <?php
    include "common/header.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/ProductTable.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/views/product_big.php";

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
                        <p>Giỏ hàng của bạn <span><?php echo sizeof($_SESSION['cart']) ?></span> <span>Sản Phẩm</span></p>
                    </div>
                    <div class="product-list-content">
                        <table>
                            <tr class="head">
                                <th>TÊN SẢN PHẨM</th>
                                <th>MÀU SẮC</th>
                                <th>SỐ LƯỢNG</th>
                                <th>TỔNG TIỀN</th>
                            </tr>
                            <tbody id="product-container">

                            </tbody>
                        </table>
                    </div>
                    <div><a href="shop.php">Tiếp tục mua hàng</a></div>
                </div>
            </div>
            <div class="container-right">
                <div class="cart-summary">
                    <h3>Tổng tiền giỏ hàng</h3>
                    <div>
                        <p><span class="total_product">Tổng sản phẩm</span></p><span><?php echo sizeof($_SESSION['cart']) ?></span>
                    </div>
                    <div>
                        <p>Tổng tiền hàng </p>
                        <p><span class="total_money">0</span><sup>đ</sup></p>
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