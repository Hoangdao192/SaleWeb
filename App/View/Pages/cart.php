<?php
use Core\HTML;

$cartSize = $data["cartSize"];
?>

<link rel="stylesheet" href="<?php echo HTML::style("product-cart.css")?>">
<link rel="stylesheet" href="<?php echo HTML::style("font.css")?>">

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
                    <p>Giỏ hàng của bạn <span><?php echo $cartSize?></span><span> Sản Phẩm</span></p>
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
                <div><a href="http://localhost/saleweb/shop">Tiếp tục mua hàng</a></div>
            </div>
        </div>
        <div class="container-right">
            <div class="cart-summary">
                <h3>Tổng tiền giỏ hàng</h3>
                <div>
                    <p><span class="total_product">Tổng sản phẩm</span></p><span><?php echo $cartSize?></span>
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
<script src="<?php echo HTML::script("cart.js")?>"></script>