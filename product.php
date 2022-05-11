<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/models/Product.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/ProductTable.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/ProductTypeTable.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/CategoryTable.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/views/product_big.php";

$relatedProducts;
if (isset($_GET['productId'])) {
    $productId = $_GET['productId'];
    $productTable = new ProductTable;
    $product = $productTable->getProduct($productId);

    $relatedProducts = $productTable->getAllFilterByType($product->typeId);
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
    <link rel="shortcut icon" href="images/favicon.png" type="images/x-icon">
    <title>TEAM BCD - Male faction</title>
    <script>
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
                url: 'app/database/ShoppingCart.php',
                data: {
                    action: 'add',
                    productId: productId,
                    productSize: productSize,
                    productColor: productColor,
                    productQuantity: inputQuantity.value
                },
                success: function(response) {
                    document.getElementById("cart-product-number").innerHTML = response;
                    toast({
                        title: "Đã thêm vào giỏ hàng",
                        message:  ""
                    });
                }
            });
        }

        function showProductDetail(productId) {
            console.log("clicked");
                    window.location.href = "./product.php?productId=" + productId;
        }

        function buyNow(productId, productSize, colorRadioGroupId, quantity) {
            addToCart(productId, productSize, colorRadioGroupId, quantity);
            window.location.href = "cart.php";
        }
    </script>
</head>

<body>
    <!-----------------------------------Header------------------------------------------------------------>
    <?php
    include "common/header.php";
    ?>
    <section class="directory">
        <h1><?php echo $product->name ?></h1>
        <p>Trang chủ &nbsp;<span></span>&nbsp; Cửa hàng &nbsp;<span></span>&nbsp; <?php echo $product->name?></p>
    </section>
    <!-------------------------Detail Product----------------------------------------------------------------------->
    <section class="product">
        <div class="detail-product">
            <div class="detail-product-image">
                <div class="detail-product-image-main">
                    <img src="admin/database/<?php echo $product->imagePath?>" alt="detail_product">
                </div>
            </div>
            <div class="detail-product-infomation">
                <h1><?php echo $product->name?></h1>
                <div class="detail-product__sup-info">
                    <p>MSP: <span><?php echo $product->id?></span></p>
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
                    <p><b><?php echo number_format($product->price, 0, ',', '.') ?><sup>đ</sup></b>
                    </p>
                </div>
                <div class="detail-product__color">
                    <p>Mã màu: <span>#233234</span></p>
                    <div id="product-color-select" class="product-color">
                        <?php
                        $colorArray = $product->color;
                        for ($i = 0; $i < sizeof($colorArray); $i++) {
                            $radioButtonName = "2color" . $product->id;
                            $radioButtonId = "2color" . $product->id . "-" . $i;
                            $radioChecked = "";
                            if ($i == 0) {
                                $radioChecked = "checked";
                            }
                        ?>
                            <div class="product-color-item">
                                <input value="<?php echo $colorArray[$i] ?>" type="radio" class="radio" name="<?php echo $radioButtonName ?>" <?php echo $radioChecked ?> id="<?php echo $radioButtonId ?>">
                                <label style="background-color: <?php echo $colorArray[$i] ?>" for="<?php echo $radioButtonId ?>" class="radio-label">
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
                    <button onclick="addToCart(<?php echo $product->id?>, 'detail-product__size', 'product-color-select')">
                        THÊM VÀO GIỎ</button>
                    <button onclick="buyNow(<?php echo $product->id?>, 'detail-product__size', 'product-color-select')">MUA HÀNG</button>
                </div>
            </div>
            <!-------------------------Related Product----------------------------------------------------------------------->
            <div class="related-product">
                <p>Sản phẩm liên quan</p>
                <div class="related-product-list">
                <!-----Thêm vào bằng ajax----------->
                <?php
                    for ($i = 0; $i < sizeof($relatedProducts); ++$i) {
                        $relatedProduct = $relatedProducts[$i];
                        if ($product->id == $relatedProduct->id) continue;
                        if ($i > 4) break;

                        product_big($relatedProduct);
                    }
                ?>
                </div>
            </div>
        </div>
    </section>
    <?php
    include "common/footer.php"
    ?>
</body>

<script src="javascript/detail-product.js"></script>
</html>