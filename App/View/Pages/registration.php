<?php
use Core\HTML;
?>
<link rel="stylesheet" href="<?php echo HTML::style("login.css")?>">

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
<div class="form">
    <form action="http://localhost/saleweb/registerinput" method="POST">
        <div class="form--item form__username">
            <i class="fa-solid fa-user form--item__icon form__username__icon"></i>
            <input name="userName" pattern="[^\s]+" class="form--item__input form__username__input" type="text" placeholder="Tên tài khoản" title="Không chứa dấu cách">
        </div>
        <div class="form--item form__password">
            <i class="fa-solid fa-lock form--item__icon form__password__icon"></i>
            <input name="userPassword" class="form--item__input form__password__input" type="password" placeholder="Mật khẩu">
        </div>
        <button type="submit" class="form__submitbtn">Đăng ký</button>
        <div class="form__more">
            Bạn đã có tài khoản ? <a class="form__more__signup" href="http://localhost/saleweb/login">Đăng nhập</a>
        </div>
    </form>
</div>
<script>
    if (document.getElementById('message')) {
        setTimeout(function(){
            toast({title: document.getElementById('message').value, description: ""});
        }, 500);
    }
</script>