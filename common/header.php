<section class="header">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                type: 'post',
                url: 'admin/ShoppingCartAction.php',
                data: {
                    action: 'count'
                },
                success: function(data) {
                    document.getElementById("cart-product-number").innerHTML = data;
                }
            });
        });    
    </script>
<div class="logo">
    <a href=""><img src="images/logo.png"></a>
</div>
<div class="menu">
    <li><a href="index">Trang chủ</a></li>
    <li><a href="shop">Cửa hàng</a></li>
    <li><a href="#">Blog</a></li>
    <li><a href="#">Liên lạc</a></li>
</div>
<div class="other">
    <div>
        <a href="#"><img src="images/icon/search.png"></a>
    </div>
    <div>
        <a href="#"><img src="images/icon/heart.png"></a>
    </div>
    <div class="quantity">
        <a href="cart"><img src="images/icon/cart.png"><span id="cart-product-number"></span></a>
    </div>
    <div class="price">$0.00</div>
</div>
</section>
