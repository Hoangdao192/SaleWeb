<?php
include_once "admin/Product.php";

if (isset($_GET['productId'])) {
    $productId = $_GET['productId'];
    $product = new Product;
    $showProduct = $product->get_product($productId);
    $currentProduct = $showProduct->fetch_assoc();

    $showRelatedProduct = $product->show_product_by_type($currentProduct['productTypeId']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/74e2dc450b.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/font.css">
    <link rel="stylesheet" href="css/detail-product.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/product.css">
    <title>TEAM BCD - Male faction</title>
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

        function addToCart(productId, productSize, colorRadioGroupId, quantity) {
            console.log(productId);

            //  Get size
            var allSizeElement = document.querySelectorAll(".detail-product__size span");
            for (let i = 0; i < allSizeElement.length; ++i) {
                if (allSizeElement[i].classList.contains("select-size")) {
                    productSize = allSizeElement[i].innerHTML;
                }
            }

            //  Get selected color
            var radioGroup = document.getElementById(colorRadioGroupId);
            console.log(radioGroup);
            var radioArray = radioGroup.querySelectorAll(".radio");
            console.log(radioArray);
            var productColor;
            for (let i = 0; i < radioArray.length; i++) {
                if (radioArray[i].checked) {
                    productColor = radioArray[i].value;
                }
            }

            //  Quantity
            var inputQuantity = document.querySelector(".detail-product__quantity input");

            console.log(productId + " " + productSize + " " + productColor + " " + inputQuantity.value);
            $.ajax({
                type: 'post',
                url: 'admin/ShoppingCartAction.php',
                data: {
                    action: 'add',
                    productId: productId,
                    productSize: productSize,
                    productColor: productColor,
                    productQuantity: inputQuantity.value
                },
                success: function(response) {
                    document.getElementById("cart-product-number").innerHTML = response;
                }
            });
        }
    </script>
</head>

<body>
    <!-----------------------------------Header------------------------------------------------------------>
    <?php
    include "php/header.php";
    ?>
    <section class="directory">
        <h1><?php echo $currentProduct['productName'] ?></h1>
        <p>Trang chủ &nbsp;<span></span>&nbsp; Cửa hàng &nbsp;<span></span>&nbsp; <?php echo $currentProduct['productName'] ?></p>
    </section>
    <!-------------------------Detail Product----------------------------------------------------------------------->
    <section class="product">
        <div class="detail-product">
            <div class="detail-product-image">
                <div class="detail-product-image-main">
                    <img src="admin/database/<?php echo $currentProduct['productImagePath'] ?>" alt="detail_product">
                </div>
            </div>
            <div class="detail-product-infomation">
                <h1><?php echo $currentProduct['productName'] ?></h1>
                <div class="detail-product__sup-info">
                    <p>MSP: <span><?php echo $currentProduct['productId'] ?></span></p>
                    <div class="detail-product__rate-star">
                        <p> <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <span>(0 đánh giá)</span>
                        </p>
                    </div>
                </div>
                <div class="detail-product__price">
                    <p><b><?php echo number_format($currentProduct['productPrice'], 0, ',', '.') ?><sup>đ</sup></b>
                    </p>
                </div>
                <div class="detail-product__color">
                    <p>Mã màu: <span>#233234</span></p>
                    <div id="product-color-select" class="product-color">
                        <?php
                        $colorArray = $currentProduct['productColor'];
                        $splitRegex = "/,/";
                        $splitResult = preg_split($splitRegex, $colorArray);
                        for ($i = 0; $i < sizeof($splitResult); $i++) {
                            $radioButtonName = "2color" . $currentProduct['productId'];
                            $radioButtonId = "2color" . $currentProduct['productId'] . "-" . $i;
                            $radioChecked = "";
                            if ($i == 0) {
                                $radioChecked = "checked";
                            }
                        ?>
                            <div class="product-color-item">
                                <input value="<?php echo $splitResult[$i] ?>" type="radio" class="radio" name="<?php echo $radioButtonName ?>" <?php echo $radioChecked ?> id="<?php echo $radioButtonId ?>">
                                <label style="background-color: <?php echo $splitResult[$i] ?>" for="<?php echo $radioButtonId ?>" class="radio-label">
                                    <i class="fa-xs fa-solid fa-check"></i>
                                </label>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="detail-product__size">
                    <span class="select-size">S</span>
                    <span>M</span>
                    <span>L</span>
                    <span>XL</span>
                    <span>XXL</span>
                </div>
                <div class="detail-product__quantity">
                    <p>Số lượng</p>
                    <div class="number">
                        <div class="number-increase">+</div>
                        <input readonly type="number" value="1" min="1" max="10" name="quantity">
                        <div class="number-decrease">-</div>
                    </div>
                </div>
                <div class="detail-product__action">
                    <button onclick="addToCart(<?php echo $currentProduct['productId'] ?>, 'detail-product__size', 'product-color-select')">
                        THÊM VÀO GIỎ</button>
                    <button>MUA HÀNG</button>
                </div>
            </div>
            <!-------------------------Related Product----------------------------------------------------------------------->
            <div class="related-product">
                <p>Sản phẩm liên quan</p>
                <div class="related-product-list">
                <!-----Thêm vào bằng ajax----------->
                </div>
            </div>
        </div>
    </section>
    <?php
    include "php/footer.php"
    ?>
</body>

<script src="javascript/detail-product.js"></script>
<script>
    <?php
    $i = 0;
    while ($result = $showRelatedProduct->fetch_assoc()) {
        if ($currentProduct['productId'] == $result['productId']) continue;
        $i++;
        if ($i > 4) break;
   ?>
        $.ajax({
            type: 'post',
            url: 'admin/ProductToHTML.php',
            data: {
                productId: '<?php echo $result['productId'] ?>',
                productImagePath: '<?php echo $result['productImagePath'] ?>',
                productColorArray: '<?php echo $result['productColor'] ?>',
                productName: '<?php echo $result['productName'] ?>',
                productPrice: '<?php echo $result['productPrice'] ?>'
            },
            success: function(data) {
                document.querySelector(".related-product-list").innerHTML += data;
            }
        });
    <?php
    }
    ?>
</script>

</html>