<?php
use Core\HTML;
use App\View;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a914f93d25.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php echo HTML::style("header.css")?>">
    <link rel="stylesheet" href="<?php echo HTML::style("footer.css")?>">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="<?php echo HTML::script("header.js")?>"></script>
    <link rel="shortcut icon" href="<?php echo HTML::image("favicon.png")?>" type="images/x-icon">
    <title>B.C.D</title>
    <script>
        console.log(document.location.pathname);
    </script>
</head>
<script>
    function logOut() {
        var request = new XMLHttpRequest();
        request.open('POST', 'http://localhost/saleweb/ajax/logout', true);
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

<body>
    <!--Header start-->
    <section class="header">
        <div class="logo">
            <a href="index"><img src="<?php echo HTML::image("logo.png")?>"></a>
        </div>
        <div class="menu">
            <li><a class="menu__home" href="http://localhost/saleweb/home">Trang chủ</a></li>
            <li><a class="menu__shop" href="http://localhost/saleweb/shop">Cửa hàng</a></li>
            <li><a class="menu__blog" href="http://localhost/saleweb/blog">Blog</a></li>
            <li><a class="menu__contact" href="http://localhost/saleweb/contact">Liên lạc</a></li>
        </div>
        <div class="other">
            <div>
                <a href="shop"><img src="<?php echo HTML::image("icon/search.png")?>"></a>
            </div>
            <div class="quantity">
                <a href="http://localhost/saleweb/cart"><img src="<?php echo HTML::image("icon/cart.png")?>"><span id="cart-product-number"></span></a>
            </div>
            <?php
            if (isset($data['user'])) {
                $user = json_decode($data['user']);
                $dashboardUrl = "http://localhost/saleweb/user/dashboard";
                if ($user->userName == "admin") {
                    $dashboardUrl = "http://localhost/saleweb/admin/home";
                }
            ?>
                <div class="other__user">
                    <i class="fa-solid fa-user"></i>
                    <p class="other__user__username"><?php echo $user->userName ?></p>
                    <div class="other__user__submenu">
                        <a href="<?php echo $dashboardUrl ?>" class="other__user__submenu__dashboard">Trang chính</a>
                        <p onclick="logOut()" class="other__user__logout">Đăng xuất</p>
                    </div>
                </div>
            <?php
            } else {
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
    <!--Header end-->

    <!--Content start-->
    <section>
        <?php
            if (isset($data["page"])) {
                View::render($data["page"], $data);
            }
        ?>
    </section>
    <!--Content end-->

    <!--Footer start-->
    <footer class="footer">
        <div class="footer__container">
            <div class="footer__row">
                <div class="footer__about">
                    <div class="footer__logo">
                        <a href=""><img src="<?php echo HTML::image("footer-logo.png")?>" alt=""></a>
                    </div>
                    <p>Khách hàng luôn luôn là ưu tiên hàng đầu của chúng tôi.</p>
                    <div class="footer__payment">
                        <a href=""><img src="<?php echo HTML::image("payment.png")?>"></a>
                    </div>
                </div>
                <div class="footer__widget">
                    <b>MUA SẮM</b>
                    <ul>
                        <li><a href="shop">Quần áo nam</a></li>
                        <li><a href="shop">Quần áo nữ</a></li>
                        <li><a href="shop">Phụ kiện</a></li>
                    </ul>
                </div>
                <div class="footer__widget">
                    <b>THÔNG TIN</b>
                    <ul>
                        <li><a href="">Liên hệ</a></li>
                        <li><a href="">Phương thức thanh toán</a></li>
                        <li><a href="">Vân chuyển</a></li>
                        <li><a href="">Đổi trả</a></li>
                    </ul>
                </div>
                <div class="footer__widget">
                    <b>NHẬN THÔNG BÁO</b>
                    <p>Trở thành người đầu tiên nhận được thông tin về sản phẩm mới và nhưng khuyến mãi hấp dẫn.</p>
                    <form action="">
                        <input type="email" placeholder="Nhập email">
                        <button type="submit"><i class="fa fa-envelope-o" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
            <div class="footer__copyright">
                <p>Được phát triển với 
                    <i class="fa fa-heart-o" aria-hidden="true"></i> bởi <a href="https://github.com/Hoangdao192/SaleWeb">Team BCD</a>
                </p>
            </div>
        </div>
    </footer>
    <!--Footer end-->
</body>
</html>