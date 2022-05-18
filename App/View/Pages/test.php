<?php
use Core\HTML;
?>
<link rel="stylesheet" href="<?php echo HTML::style("login.css")?>">
<link rel="stylesheet" href="<?php echo HTML::style("registration.css")?>">

<div class="title">
    ĐĂNG KÝ TÀI KHOẢN
</div>
<?php
    if (isset($data['message'])) {
?>
<input id="message" type="text" style="display: none;" value="<?php echo $data['message']?>">
<?php
    }
?>
<div class="form account-form">
    <form action="http://localhost/saleweb/registerinput" method="POST" onsubmit="return validate()">
        <div class="form__account">
            <div class="form--item form__username">
                <i class="fa-solid fa-user form--item__icon form__username__icon"></i>
                <input required name="userName" pattern="[^\s]+" class="form--item__input form__username__input" type="text" placeholder="Tên tài khoản" title="Không chứa dấu cách">
            </div>
            <div class="form--item form__password">
                <i class="fa-solid fa-lock form--item__icon form__password__icon"></i>
                <input required name="userPassword" class="form--item__input form__password__input" type="password" placeholder="Mật khẩu">
            </div>
            <div class="form--item form__password">
                <i class="fa-solid fa-circle-check form--item__icon form__password__icon"></i>
                <input required name="userPassword" class="form--item__input form__password__check" type="password" placeholder="Nhập lại mật khẩu">
            </div>
            <button class="form__next form__submitbtn">Tiếp tục</button>
            <div class="form__more">
                Bạn đã có tài khoản ? <a class="form__more__signup" href="http://localhost/saleweb/login">Đăng nhập</a>
            </div>
        </div>
        <div class="form__information">
            <div class="form__information__left">
                <div class="form--item form__fullname">
                    <i class="fa-solid fa-user form--item__icon form__fullname__icon"></i>
                    <input required name="fullname" class="form--item__input form__username__input" type="text" placeholder="Nhập họ và tên">
                </div>
                <div class="form--item form__age">
                    <i class="fa-solid fa-baby form--item__icon age"></i>
                    <input required name="age" class="form--item__input form__age__input" min="1" max="200" type="number" placeholder="Nhập tuổi">
                </div>
                <div class="form--item form__gender">
                    <i class="fa-solid fa-mars-and-venus form--item__icon"></i><p>Giới tính</p>
                    <div class="radio-group">
                        <input required type="radio" name="gender" id="gender_male" value="Nam"><label for="gender_male">Nam</label><br>
                        <input required type="radio" name="gender" id="gender_female" value="Nữ"><label for="gender_male">Nữ</label><br>
                        <input required type="radio" name="gender" id="gender_other" value="Khác"><label for="gender_male">Khác</label><br>
                    </div>
                </div>
                <div class="form--item form__birth">
                    <i class="fa-solid fa-cake-candles form--item__icon form__birth__icon"></i><p>Ngày sinh</p>
                    <input required name="dateOfbirth" class="form--item__input form__birth__input" type="date" placeholder="Nhập ngày sinh">
                </div>
            </div>
            <div class="form__information__right">
                <div class="form--item form__address">
                    <i class="fa-solid fa-location-dot form--item__icon"></i>
                    <input required name="address" class="form--item__input form__address__input" type="text" placeholder="Nhập địa chỉ">
                </div>
                <div class="form--item form__phone">
                    <i class="fa-solid fa-phone form--item__icon"></i>
                    <input required name="phone" class="form--item__input form__phone__input" type="tel" placeholder="Nhập số điện thoại">
                </div>
            </div>
            <button type="submit" class="form__submitbtn">Đăng ký</button>
        </div>
    </form>
</div>
<script>
    if (document.getElementById('message')) {
        setTimeout(function(){
            toast({title: document.getElementById('message').value, description: ""});
        }, 500);
    }

    function validate() {
        var passwordInput = document.querySelector(".form__password__input");
        var passwordCheck = document.querySelector(".form__password__check");

        if (passwordInput.value === passwordCheck.value) {
            return true;
        }
        toast({
            title: 'Mật khẩu không giống nhau',
            description: ""
        })
        return false;
    }

    document.querySelector(".form__next").addEventListener('click', function(){
        if (validate()) {
            document.querySelector(".form__account").style.display = "none";
            document.querySelector(".form__information").style.display = "block";
        }
    })
</script>