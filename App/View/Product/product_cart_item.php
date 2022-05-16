<?php
use Core\HTML;

$product = $data['product'];
$orderInfor = $data['orderInfor'];

$productColor = $orderInfor[2];
$productSize = $orderInfor[1];
$productQuantity = $orderInfor[3];
?>
<tr class="content-item">
    <td>
        <div><img src="<?php echo HTML::image("database/" . $product->imagePath)?>" alt=""></div>
        <div class="content-detail">
            <input style="display: none;" class="product_price" value="<?php echo $product->price ?>">
            <p class="name-product"><?php echo $product->name ?></p>
            <p class="size">Size: <span><?php echo $productSize ?></span></p>
        </div>
    </td>
    <td>
        <div class="color_container">
            <div style="background-color: <?php echo $productColor ?>;" class="productColor"></div>
        </div>
    </td>
    <td>
        <div class="detail-product__quantity">
            <div class="number">
                <div class="number-increase">+</div>
                <input readonly type="number" value="<?php echo $productQuantity ?>" min="1" max="10" name="quantity">
                <div class="number-decrease">-</div>
            </div>
            <div class="tip-quantity">xx</div>
        </div>
    </td>
    <td>
        <div>
            <p><span class="product_total_money"><?php echo number_format(intval($product->price) * intval($productQuantity), 0, ',', '.') ?></span><sup>đ</sup></p>
            <p><i class="fa fa-trash-o delete-product" aria-hidden="true"></i></p>
        </div>
    </td>
</tr>