<?php
use Core\HTML;
?>

<link rel="stylesheet" href="<?php echo HTML::style("method-payments-ATM.css")?>">
<div class="container">
        <div class="images-head">
            <p>Chọn ngân hàng</p>
            <div class="images">
                <img src="<?php echo HTML::image("banklogo/10_logo_full.svg")?>" alt="">
                <img src="<?php echo HTML::image("banklogo/9_logo_full.svg")?>" alt="">
                <img src="<?php echo HTML::image("banklogo/8_logo_full.svg")?>" alt="">
                <img src="<?php echo HTML::image("banklogo/7_logo_full.svg")?>" alt="">
                <img src="<?php echo HTML::image("banklogo/6_logo_full.svg")?>" alt="">
                <img src="<?php echo HTML::image("banklogo/5_logo_full.svg")?>" alt="">
                <img src="<?php echo HTML::image("banklogo/4_logo_full.svg")?>" alt="">
                <img src="<?php echo HTML::image("banklogo/11_logo_full.svg")?>" alt="">
            </div>
        </div>
        <div class="input-container">
            <div>
                <p>Số thẻ</p>
                <input required type="text" placeholder="1234 5678 9101 1234">
            </div>
            <div>
                <div>
                    <p>Họ và tên</p>
                    <input required type="text" placeholder="Nguyễn Văn A">
                </div>
            </div>
            <div class="pay-button">
                <div><a href="http://localhost/saleweb/user/complete-order">Thanh toán</a></div>
            </div>
        </div>
        <div class="detail-product">
            <div>
                <p>Đơn vị chấp nhận thanh toán</p>
                <h3>BCD</h3>
            </div>
            <div>
                <p>Số tiền thanh toán</p>
                <p><span>1,100,000</span>VND</p>
            </div>
        </div>
</div>
<script src="/js/method-payments-ATM.js"></script>