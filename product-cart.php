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
    include "php/header.php";
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
                                        <div class="tip-quantity">xx</div>
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
                                        <div class="tip-quantity">xx</div>
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
                    <div><a href="">Tiếp tục mua hàng</a></div>
                </div>
            </div>
            <div class="container-right">
                <div class="cart-summary">
                    <h3>Tổng tiền giỏ hàng</h3>
                    <div>
                        <p>Tổng sản phẩm </p><span>3</span></div>
                    <div>
                        <p>Tổng tiền hàng </p>
                        <p>1.770.000<sup>đ</sup></p>
                    </div>
                    <div>
                        <p>Thành tiền </p><b>885.000<sup>đ</sup></b></div>
                    <div>
                        <p>Tạm tính </p><b>885.000<sup>đ</sup></b></div>
                </div>
                <div class="cart-sumary-note">
                    <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Miễn phí ship đơn hàng có tổng gía trị trên 2.000.000VND</p>
                    <p>Mua thêm <b>1.115.000đ</b> để được miễn phí SHIP</p>
                </div>
                <div>
                    <a href="delivery">ĐẶT HÀNG</a>
                </div>
            </div>
        </div>
    </div>

    <!-------------------------Footer----------------------------------------------------------------------->
    <?php
    include "php/footer.php"
    ?>
</body>

<script src="/js/product-cart.js"></script>

</html>