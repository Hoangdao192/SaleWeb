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
    <title>TEAM BCD - Male faction</title>
</head>

<body>
    <!-----------------------------------Header------------------------------------------------------------>
    <?php
    include "common/header.php"
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
                    <div class="user-sign-in">
                        <a href="">ĐĂNG NHẬP</a>
                        <a href="">ĐĂNG KÝ</a>
                    </div>
                    <p>Đăng nhập/ Đăng ký tài khoản để được tích điểm và nhận thêm nhiều ưu đãi từ IVY moda.</p>
                    <div class="detail-address">
                        <form action="" id="your-form">
                            <span>Địa chỉ</span>
                            <input type="text" required id="name" name="name" placeholder="Họ tên" pattern="[a-z A-z]{1,32}" title="Chứa từ 1-32 ký tự a-z, A-Z, khoảng trắng. VD: Lê Xuân Vinh">
                            <input type="tel" required id="phone" name="phone" placeholder="Số điện thoại" pattern="[0-9]{10,13}" title="Số điện thoại chứa từ 10-13 chữ số VD: 0123-456-789">
                            <input type="text" required name="province-city" id="province-city" placeholder="Tỉnh/Thành phố" pattern="[a-z A-Z]{5,20}" title="Tên tỉnh, thành phố từ 5-20 ký tự a-z, ,A-Z">
                            <input type="text" required name="dstrict" id="district" placeholder="Quận/huyện" pattern="[a-z A-Z]{5,20}" title="Tên quận, huyện từ 5-20 ký tự a-z, ,A-Z">
                            <input type="text" required name="wards" id="wards" placeholder="Xã/Phường" pattern="[a-z A-Z]{5,20}" title="Tên xã, phường từ 5-20 ký tự a-z, ,A-Z">
                            <input type="text" required name="address" id="address" placeholder="Địa chỉ">
                        </form>
                    </div>
                    <div class="button-show-product">HIỂN THỊ SẢN PHẨM</div>
                    <div class="product-list not-display">
                        <div class="product-list-tilte">
                            <p>Giỏ hàng của bạn <span>3</span> <span>Sản Phẩm</span></p>
                        </div>
                        <div class="product-list-content">
                            <table>
                                <tr class="head">
                                    <th>TÊN SẢN PHẨM</th>
                                    <th>CHIẾT KHẤU</th>
                                    <th>SỐ LƯỢNG</th>
                                    <th>TỔNG TIỀN</th>
                                </tr>
                                <tr class="content-item">
                                    <td>
                                        <div><img src="/images/detail-product/detail_product.jpg" alt=""></div>
                                        <div class="content-detail">
                                            <p class="name-product">Áo thun batman</p>
                                            <p class="color">Màu sắc: <span>Trắng</span></p>
                                            <p class="size">Size: <span>M</span></p>
                                        </div>
                                    </td>
                                    <td>
                                        <p>-295.000<sup>đ</sup><br><span>(-50%)</span></p>
                                    </td>
                                    <td>
                                        <div class="detail-product__quantity">
                                            <div class="number">
                                                <div class="number-increase">+</div>
                                                <input readonly type="number" value="1" min="1" max="10" name="quantity">
                                                <div class="number-decrease">-</div>
                                            </div>
                                            <div class="tip-quantity"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <p>295.000<sup>đ</sup></p>
                                            <p><i class="fa fa-trash-o" aria-hidden="true"></i></p>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="content-item">
                                    <td>
                                        <div><img src="/images/detail-product/detail_product.jpg" alt=""></div>
                                        <div class="content-detail">
                                            <p class="name-product">Áo thun batman</p>
                                            <p class="color">Màu sắc: <span>Trắng</span></p>
                                            <p class="size">Size: <span>M</span></p>
                                        </div>
                                    </td>
                                    <td>
                                        <p>-295.000<sup>đ</sup><br><span>(-50%)</span></p>
                                    </td>
                                    <td>
                                        <div class="detail-product__quantity">
                                            <div class="number">
                                                <div class="number-increase">+</div>
                                                <input readonly type="number" value="1" min="1" max="10" name="quantity">
                                                <div class="number-decrease">-</div>
                                            </div>
                                            <div class="tip-quantity"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <p>295.000<sup>đ</sup></p>
                                            <p><i class="fa fa-trash-o" aria-hidden="true"></i></p>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-right">
                <div class="col">
                    <div class="cart-summary">
                        <h3>Tóm tắt đơn hàng</h3>
                        <div>
                            <p>Tổng tiền hàng </p>
                            <b>1.770.000<sup>đ</sup></b>
                        </div>
                        <div>
                            <p>Tạm tính </p><b>885.000<sup>đ</sup></b></div>
                        <div>
                            <p>Phí vận chuyển</p><b>0<sup>đ</sup></b></div>
                        <div>
                            <p>Tiền thanh toán </p><b>885.000<sup>đ</sup></b></div>
                    </div>
                    <div class="enter-sale">
                        <div class="sale-title"> <b>Mã phiếu giảm giá</b> </div>
                        <div class="code-sale">
                            <input type="text" placeholder="Mã giảm giá">
                            <a href="">ÁP DỤNG</a>
                        </div>
                        <input type="text" placeholder="Mã nhân viên hỗ trợ">
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

<script src="/js/delivery.js"></script>

</html>