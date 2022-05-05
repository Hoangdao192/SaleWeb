
<?php
    function product_big($product) {
        $radioGroupId = "product-color" . $product->id;
?>
        <div class="product-item">
            <img onclick="showProductDetail(<?php echo $product->id?>)" src="admin/database/<?php echo $product->image_path?>">
            <div id="<?php echo $radioGroupId?>" class="product-color">
                <?php
                $color_array = $product->color;
                $number = rand();
                for ($i = 0; $i < sizeof($color_array); $i++) {
                    $radioButtonName = $number . "color" . $product->id;
                    $radioButtonId = $number . "color" . $product->id . "-" . $i;
                    $radioChecked = "";
                    if ($i == 0) {
                        $radioChecked = "checked";
                    }
                ?>
                    <div class="product-color-item">
                        <input value="<?php echo $color_array[$i]?>" type="radio" 
                            class="radio" name="<?php echo $radioButtonName?>" <?php echo $radioChecked?>
                            id="<?php echo $radioButtonId ?>">
                        <label style="background-color: <?php echo $color_array[$i] ?>" for="<?php echo $radioButtonId ?>" class="radio-label">
                            <i class="fa-xs fa-solid fa-check"></i>
                        </label>
                    </div>
                <?php
                }
                ?>
            </div>
            <p class="product-name"><?php echo $product->name?></p>
            <p class="product-price"><?php echo number_format($product->price, 0, ',', '.') ?><span>đ</span></p>
            <input style="display: none;" type="text" name="insert" value="insert" />
            <input style="display: none;" class="product-id-input" name="productId" value="<?php echo $product->id?>" />
            <button class="add-to-cart">
                <i class="fa-xl fa-thin fa-plus"></i>
                <div class="product-size-sub-menu">
                    <p onClick="addToCart(<?php echo $product->id?>,'S','<?php echo $radioGroupId ?>', 1)">S</p>
                    <p onClick="addToCart(<?php echo $product->id?>,'M','<?php echo $radioGroupId ?>', 1)">M</p>
                    <p onClick="addToCart(<?php echo $product->id?>,'L','<?php echo $radioGroupId ?>', 1)">L</p>
                    <p onClick="addToCart(<?php echo $product->id?>,'XL','<?php echo $radioGroupId ?>', 1)">XL</p>
                    <p onClick="addToCart(<?php echo $product->id?>,'XXL','<?php echo $radioGroupId ?>', 1)">XXL</p>
                </div>
            </button>
        </div>
<?php 
    }

    function product_cart($product, $order_infor) {
        $product_color = $order_infor[2];
        $product_size = $order_infor[1];
        $product_quantity = $order_infor[3];
    ?>
        <tr class="content-item">
            <td>
                <div><img src="admin/database/<?php echo $product->image_path?>" alt=""></div>
                <div class="content-detail">
                    <input style="display: none;" class="product_price" value="<?php echo $product->price?>">
                    <p class="name-product"><?php echo $product->name?></p>
                    <p class="size">Size: <span><?php echo $product_size?></span></p>
                </div>
            </td>
            <td>
                <div class="color_container">
                    <div style="background-color: <?php echo $product_color?>;" class="product_color"></div>
                </div>                                    
            </td>
            <td>
                <div class="detail-product__quantity">
                    <div class="number">
                        <div class="number-increase">+</div>
                        <input readonly type="number" value="<?php echo $product_quantity?>" min="1" max="10" name="quantity">
                        <div class="number-decrease">-</div>
                    </div>
                    <div class="tip-quantity">xx</div>
                </div>
            </td>
            <td>
                <div>
                    <p><span class="product_total_money"><?php echo number_format(intval($product->price) * intval($product_quantity), 0, ',', '.')?></span><sup>đ</sup></p>
                    <p><i class="fa fa-trash-o delete-product" aria-hidden="true"></i></p>
                </div>
            </td>
        </tr>
<?php
    }
?>