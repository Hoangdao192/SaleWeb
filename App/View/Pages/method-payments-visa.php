<?php
use Core\HTML;
?>
<link rel="stylesheet" href="<?php echo HTML::style("method-payments-visa.css") ?>">
<div class="container">
    <div class="images-head">
        <p>Thẻ tín dụng / Ghi nợ</p>
        <div class="images">
            <img src="<?php echo HTML::image("CUP.svg")?>" alt="">
            <img src="<?php echo HTML::image("JC.svg")?>" alt="">
            <img src="<?php echo HTML::image("MC.svg")?>" alt="">
            <img src="<?php echo HTML::image("MC.svg")?>" alt="">
        </div>
    </div>
    <div class="input-container">
        <div>
            <p>Số thẻ</p>
            <input required type="text" placeholder="1234 5678 9101 1234">
        </div>
        <div>
            <div>
                <p>Tháng/Năm hết hạn</p>
                <input required type="text" placeholder="12/25">
            </div>
            <div>
                <p>CSC</p>
                <input required type="text" placeholder="123">
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