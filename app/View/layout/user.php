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
    <link rel="shortcut icon" href="<?php echo HTML::image("favicon.png")?>" type="images/x-icon">
    <title>B.C.D</title>
    <script>
        console.log(document.location.pathname);
    </script>
</head>
<input type="hidden" id="domain-url" value="<?php echo HTML::getRootUrl()?>">
<script>
    function getDomainUrl() {
        return document.getElementById("domain-url").value;
    }
    function openPostRequest(url, data) {
        var form = document.createElement('form');
        form.action = url;
        form.method = "POST";
        form.style.display = "none";
        Object.entries(data).forEach(entry => {
            const [key, value] = entry;
            var input = document.createElement('input');
            input.type = "hidden";
            input.name = key;
            input.value = value;
            form.appendChild(input);
        });
        document.body.appendChild(form);
        form.submit();
    }
    function logOut() {
        var request = new XMLHttpRequest();
        request.open('POST', `${getDomainUrl()}/ajax/logout`, true);
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
<script src="<?php echo HTML::script("header.js")?>"></script>

<body>
    <!--Header start-->
    <section class="header">
        <div class="logo">
            <a href="<?php echo HTML::getUrl("home")?>"><img src="<?php echo HTML::image("logo.png")?>"></a>
        </div>
        <div class="menu">
            <li><a class="menu__home" href="<?php echo HTML::getUrl("home")?>">Trang ch???</a></li>
            <li><a class="menu__shop" href="<?php echo HTML::getUrl("shop")?>">C???a h??ng</a></li>
            <li><a class="menu__blog" href="<?php echo HTML::getUrl("blog")?>">Blog</a></li>
            <li><a class="menu__contact" href="<?php echo HTML::getUrl("contact")?>">Li??n l???c</a></li>
        </div>
        <div class="other">
            <div>
                <a href="shop"><img src="<?php echo HTML::image("icon/search.png")?>"></a>
            </div>
            <div class="quantity">
                <a href="<?php echo HTML::getUrl("cart")?>"><img src="<?php echo HTML::image("icon/cart.png")?>"><span id="cart-product-number"></span></a>
            </div>
            <?php
            if (isset($data['user'])) {
                $user = json_decode($data['user']);
                $dashboardUrl = HTML::getUrl("user/profile");
                if ($user->userName == "admin") {
                    $dashboardUrl = HTML::getUrl("admin/home");
                }
            ?>
                <div class="other__user">
                    <i class="fa-solid fa-user"></i>
                    <p class="other__user__username"><?php echo $user->userName ?></p>
                    <div class="other__user__submenu">
                        <a href="<?php echo $dashboardUrl ?>" class="other__user__submenu__dashboard">Trang ch??nh</a>
                        <p onclick="logOut()" class="other__user__logout">????ng xu???t</p>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <div class="other__login">
                    <a href="login">????ng nh???p</a>
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
                    <p>Kh??ch h??ng lu??n lu??n l?? ??u ti??n h??ng ?????u c???a ch??ng t??i.</p>
                    <div class="footer__payment">
                        <a href=""><img src="<?php echo HTML::image("payment.png")?>"></a>
                    </div>
                </div>
                <div class="footer__widget">
                    <b>MUA S???M</b>
                    <ul>
                        <li><a href="shop">Qu???n ??o nam</a></li>
                        <li><a href="shop">Qu???n ??o n???</a></li>
                        <li><a href="shop">Ph??? ki???n</a></li>
                    </ul>
                </div>
                <div class="footer__widget">
                    <b>TH??NG TIN</b>
                    <ul>
                        <li><a href="">Li??n h???</a></li>
                        <li><a href="">Ph????ng th???c thanh to??n</a></li>
                        <li><a href="">V??n chuy???n</a></li>
                        <li><a href="">?????i tr???</a></li>
                    </ul>
                </div>
                <div class="footer__widget">
                    <b>NH???N TH??NG B??O</b>
                    <p>Tr??? th??nh ng?????i ?????u ti??n nh???n ???????c th??ng tin v??? s???n ph???m m???i v?? nh??ng khuy???n m??i h???p d???n.</p>
                    <form action="">
                        <input type="email" placeholder="Nh???p email">
                        <button type="submit"><i class="fa fa-envelope-o" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
            <div class="footer__copyright">
                <p>???????c ph??t tri???n v???i 
                    <i class="fa fa-heart-o" aria-hidden="true"></i> b???i <a href="https://github.com/Hoangdao192/SaleWeb">Team BCD</a>
                </p>
            </div>
        </div>
    </footer>
    <!--Footer end-->
</body>
</html>