<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/74e2dc450b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/font.css">
    <link rel="stylesheet" href="css/delivery.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="shortcut icon" href="images/favicon.png" type="images/x-icon">
    <title>TEAM BCD - Male faction</title>
</head>

<body>
    <!-----------------------------------Header------------------------------------------------------------>
    <?php
    include "common/header.php";

    $total_purchase = 0;
    if (isset($_GET['totalPurchase'])) {
        $total_purchase = intval($_GET['totalPurchase']);
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
                <div class="address">
                    <h3>Địa chỉ giao hàng</h3>
                    <div class="detail-address">
                        <form action="" id="your-form">
                            <input type="text" required id="name" name="name" placeholder="Họ tên" title="Chứa từ 1-32 ký tự a-z, A-Z, khoảng trắng. VD: Lê Xuân Vinh">
                            <div class="telephone">
                                <input type="tel" required id="phone" name="phone" placeholder="Số điện thoại" pattern="[0-9]{10,13}" title="Số điện thoại chứa từ 10-13 chữ số VD: 0123-456-789">
                                <?php
                                if (!isset($_SESSION['user'])) {
                                ?>
                                <p class="telephone__authenication">Xác minh</p>
                                <?php
                                }
                                ?>
                            </div>
                            
                            <select name="province-city" id="province-city" onchange="provinceSelected()">
                            </select>
                            <div class="telephone telephone__validate">
                                <input type="text" required id="validate-code" name="validate-code" placeholder="Nhập mã xác minh">
                                <p class="telephone__validate__ok" validated="0">OK</p>
                            </div>
                            
                            <select name="district" id="district" onchange="districtSelected()">
                                <option value="-1">Quận/Huyện</option>
                            </select>
                            <select name="wards" id="wards">
                                <option value="-1">Xã/Phường</option>
                            </select>
                            <input type="text" required name="address" id="address" placeholder="Địa chỉ">
                        </form>
                    </div>
                    <div class="button-show-product"><a href="cart.php">QUAY LẠI GIỎ HÀNG</a></div>
                </div>
            </div>
            <div class="container-right">
                <div class="col">
                    <div class="cart-summary">
                        <h3>Tóm tắt đơn hàng</h3>
                        <div>
                            <p>Tổng tiền hàng </p>
                            <b><?php echo number_format($total_purchase, 0, ',', '.')?><sup>đ</sup></b>
                        </div>
                        <div>
                            <p>Phí vận chuyển</p><b>0<sup>đ</sup></b>
                        </div>
                        <div>
                            <p>Tiền thanh toán </p><b><?php echo number_format($total_purchase, 0, ',', '.')?><sup>đ</sup></b></div>
                    </div>
                    <div>
                        <input type="submit" id="submit" name="submit" form="your-form" value="HOÀN THÀNH">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-------------------------Footer----------------------------------------------------------------------->
    <?php
    include "common/footer.php"
    ?>
</body>
<script src="javascript/delivery.js"></script>
</html>