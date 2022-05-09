<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<link rel="stylesheet" href="css/header.css">
<script src="javascript/header.js"></script>
<script>
    function logOut() {
        var request = new XMLHttpRequest();
        request.open('GET', 'logout.php', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        request.onload = function() {
            if (this.status >= 200 && this.status < 400) {
                // Success!
                location.reload();
            }
        };
        request.send();
    }
</script>
<section class="header">
    <div class="logo">
        <a href="index"><img src="images/logo.png"></a>
    </div>
    <div class="menu">
        <li><a class="menu__home" href="index">Trang chủ</a></li>
        <li><a class="menu__shop" href="shop">Cửa hàng</a></li>
        <li><a class="menu__blog" href="blog">Blog</a></li>
        <li><a class="menu__contact" href="contact">Liên lạc</a></li>
    </div>
    <div class="other">
        <div>
            <a href="#"><img src="images/icon/search.png"></a>
        </div>
        <div class="quantity">
            <a href="cart"><img src="images/icon/cart.png"><span id="cart-product-number"></span></a>
        </div>
        <?php 
        if (isset($_SESSION['user'])) {
            $user = json_decode($_SESSION['user']);
            $dashboardUrl = "customer/index";
            if ($user->userName == "admin") {
                $dashboardUrl = "admin/index";
            }
        ?>
        <div class="other__user">
            <i class="fa-solid fa-user"></i>
            <p class="other__user__username"><?php echo $user->userName?></p>
            <div class="other__user__submenu">
                <a href="<?php echo $dashboardUrl?>" class="other__user__submenu__dashboard">Trang chính</a>
                <p onclick="logOut()" class="other__user__logout">Đăng xuất</p>
            </div>
        </div>
        <?php
        } 
        else {
        ?>
        <div class="other__login">
            <a href="login">Đăng nhập</a>
        </div>
        <?php
        }
        ?>
        <div class="price"></div>
    </div>
    <div id="toast">
    </div>
</section>