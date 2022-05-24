<?php
use Core\HTML;
?>

<link rel="stylesheet" href="<?php echo HTML::style("contact.css")?>">
<!-------------------------Content----------------------------------------------------------------------->
<div class="map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2166.7814706005647!2d105.78079049139215!3d21.037792072877803!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454b55b011e49%3A0x9406c12dc4604160!2zxJDhuqFpIGjhu41jIFF14buRYyBnaWEgSMOgIE7hu5lp!5e0!3m2!1svi!2s!4v1651998612863!5m2!1svi!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
<div class="container">
    <div class="content-left">
        <h2>THÔNG TIN</h2>
        <div class="information">
            <p>Website được phát triển bởi nhóm BCD</p>
            <p>Trần Thị Kim Bắc: Xây dựng cơ sở dữ liệu</p>
            <p>Trần Đình Cường: Thiết kế giao diện (front-end)</p>
            <p>Nguyễn Đăng Hoàng Đạo: Lập trình back-end</p>
        </div>
        <h2>LIÊN HỆ</h2>
        <p>Mang đến sức sống cho cuộc sống là sứ mệnh của chúng tôi.</p>
        <div class="address">
            <h3>Hà Nội</h3>
            <p>144 Xuân Thủy, Cầu Giấy, Hà Nội</p>
            <p>SĐT: 024-37547-461</p>
        </div>
    </div>
    <div class="content-right">
        <input type="text" placeholder="Tên">
        <input type="email" placeholder="Email">
        <textarea name="content" id="content" cols="30" rows="10" placeholder="Nội dung"></textarea>
        <div class="messager">
            <a href="">Gửi tin nhắn</a>
        </div>
    </div>
</div>


<script>
    const menuContact = document.querySelector(".menu__contact");
    menuContact.classList.add("menu__item__underline");
</script>