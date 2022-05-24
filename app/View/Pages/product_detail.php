<?php
use App\View;
use Core\HTML;

$relatedProducts = $data['relatedProducts'];
$product = $data['product'];
?>
<link rel="stylesheet" href="<?php echo HTML::style("font.css") ?>">
<link rel="stylesheet" href="<?php echo HTML::style("detail-product.css") ?>">
<link rel="stylesheet" href="<?php echo HTML::style("product.css") ?>">
<section class="directory">
    <h1><?php echo $product->name ?></h1>
    <p>Trang chủ &nbsp;<span></span>&nbsp; Cửa hàng &nbsp;<span></span>&nbsp; <?php echo $product->name ?></p>
</section>
<!-------------------------Detail Product----------------------------------------------------------------------->
<section class="product">
    <div class="detail-product">
        <div class="detail-product-image">
            <div class="detail-product-image-main">
                <img src="<?php echo HTML::image('database/' . $product->imagePath)?>" alt="detail_product">
            </div>
        </div>
        <div class="detail-product-infomation">
            <h1><?php echo $product->name ?></h1>
            <div class="detail-product__sup-info">
                <p>MSP: <span><?php echo $product->id ?></span></p>
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
                <button onclick="addToCartMain(<?php echo $product->id ?>, 'detail-product__size', 'product-color-select')">
                    THÊM VÀO GIỎ</button>
                <button onclick="buyNow(<?php echo $product->id ?>, 'detail-product__size', 'product-color-select')">MUA HÀNG</button>
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
                    View::render("Product/product_thumbnail", ['product' => $relatedProduct]);
                }
                ?>
            </div>
        </div>
    </div>
</section>
<script src="<?php echo HTML::script("detail-product.js")?>"></script>