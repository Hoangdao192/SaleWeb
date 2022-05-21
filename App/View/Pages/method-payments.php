<?php
use Core\HTML;
?>
<link rel="stylesheet" href="<?php echo HTML::style("method-payments.css") ?>">
<div class="container">
    <p>Mọi giao dịch đều được bảo mật và mã hóa. Thông tin thẻ tín dụng sẽ không bao giờ được lưu lại.</p>
    <div><a href="<?php echo HTML::getUrl("user/visa-payment")?>">Thanh toán bằng thẻ tín dụng</a></div>
    <div><a href="<?php echo HTML::getUrl("user/atm-payment")?>">Thanh toán bằng thẻ ATM</a></div>
    <div><a href="<?php echo HTML::getUrl("user/complete-order")?>">Thanh toán khi giao hàng</a></div>
</div>