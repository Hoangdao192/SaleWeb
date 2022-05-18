
<?php
use Core\HTML;

$totalPurchase = $data['totalPurchase'];
?>

<link rel="stylesheet" href="<?php echo HTML::style("font.css")?>">
<link rel="stylesheet" href="<?php echo HTML::style("delivery.css")?>">
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
                <div class="all-address">
                    <input class="address-radio" type="radio" style="display: none;" value="id" name="shpping-address" id="shipping-address-id">
                    <label class="shipping-address-label" for="shipping-address-id">
                        <div class="ring"></div>
                        <div class="label-detail">
                            <p>Người nhận: </p>
                            <p>Số điện thoại</p>
                            <p>Địa chỉ</p>
                        </div>
                    </label>
                </div>
                <button class="create-address secondary-button">ĐỊA CHỈ MỚI</button>
                <div class="detail-address new-address">
                    <form action="" id="your-form">
                        <input type="text" required id="name" name="name" placeholder="Họ tên" title="Chứa từ 1-32 ký tự a-z, A-Z, khoảng trắng. VD: Lê Xuân Vinh">
                        <div class="telephone">
                            <input type="tel" required id="phone" name="phone" placeholder="Số điện thoại" pattern="[0-9]{10,13}" title="Số điện thoại chứa từ 10-13 chữ số VD: 0123-456-789">
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
                        <input type="text" required name="address" id="address" placeholder="Thôn/Bản/Tổ dân phố/Đường/Số nhà">
                        <button class="save-address secondary-button">LƯU</button>
                    </form>
                </div>
                <div class="button-show-product"><a href="http://localhost/saleweb/cart">QUAY LẠI GIỎ HÀNG</a></div>
            </div>
        </div>
        <div class="container-right">
            <div class="col">
                <div class="cart-summary">
                    <h3>Tóm tắt đơn hàng</h3>
                    <div>
                        <p>Tổng tiền hàng </p>
                        <b><?php echo number_format($totalPurchase, 0, ',', '.') ?><sup>đ</sup></b>
                    </div>
                    <div>
                        <p>Phí vận chuyển</p><b>0<sup>đ</sup></b>
                    </div>
                    <div>
                        <p>Tiền thanh toán </p><b><?php echo number_format($totalPurchase, 0, ',', '.') ?><sup>đ</sup></b>
                    </div>
                </div>
                <div>
                    <input type="text" id="submit" name="submit" form="your-form" value="HOÀN THÀNH">
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo HTML::script("delivery.js")?>"></script>