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

        function toast({
            title, message
        }) {
            var toastContainer = document.getElementById("toast");
            var toastItem = document.createElement('div');
            toastItem.classList.add("toast-item");
        
            toastItem.innerHTML = `
                <div class="toast__check-icon">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div class="toast__message">
                <p class="toast__message__title">${title}</p>
                </div>
                <i class="fa-solid fa-xmark toast__close-icon"></i>
            `;
            toastContainer.appendChild(toastItem);

            setTimeout(function (){
                toastContainer.removeChild(toastItem);
            }, 4000);
        }
    </script>

    <div class="logo">
        <a href="index"><img src="images/logo.png"></a>
    </div>
    <div class="menu">
        <li><a class="menu__home" href="index">Trang chủ</a></li>
        <li><a class="menu__shop" href="shop">Cửa hàng</a></li>
        <li><a class="menu__blog" href="#">Blog</a></li>
        <li><a class="menu__contact" href="#">Liên lạc</a></li>
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
    <div id="toast">
    </div>
</section>