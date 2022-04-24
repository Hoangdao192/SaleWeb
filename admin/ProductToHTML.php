<?php
$productId = $_POST['productId'];
$productImagePath = $_POST['productImagePath'];
$productColorArray = $_POST['productColorArray'];
$productName = $_POST['productName'];
$productPrice = $_POST['productPrice'];
?>

<?php
    $radioGroupId = "product-color" . $productId;
?>
    <div class="product-item">
        <img onclick="showProductDetail(<?php echo $productId?>)" src="admin/database/<?php echo $productImagePath?>">
        <div id="<?php echo $radioGroupId?>" class="product-color">
            <?php
            $splitRegex = "/,/";
            $splitResult = preg_split($splitRegex, $productColorArray);
            for ($i = 0; $i < sizeof($splitResult); $i++) {
                $radioButtonName = "2color" . $productId;
                $radioButtonId = "2color" . $productId . "-" . $i;
                $radioChecked = "";
                if ($i == 0) {
                    $radioChecked = "checked";
                }
            ?>
                <div class="product-color-item">
                    <input value="<?php echo $splitResult[$i]?>" type="radio" class="radio" name="<?php echo $radioButtonName?>" <?php echo $radioChecked?> id="<?php echo $radioButtonId ?>">
                    <label style="background-color: <?php echo $splitResult[$i] ?>" for="<?php echo $radioButtonId ?>" class="radio-label">
                        <i class="fa-xs fa-solid fa-check"></i>
                    </label>
                </div>
            <?php
            }
            ?>
        </div>
        <p class="product-name"><?php echo $productName?></p>
        <p class="product-price"><?php echo number_format($productPrice, 0, ',', '.') ?><span>đ</span></p>
        <input style="display: none;" type="text" name="insert" value="insert" />
        <input style="display: none;" class="product-id-input" name="productId" value="<?php echo $productId?>" />
        <button class="add-to-cart">
            <i class="fa-xl fa-thin fa-plus"></i>
            <div class="product-size-sub-menu">
                <p onClick="addToCart(<?php echo $productId?>,'S','<?php echo $radioGroupId ?>', 1)">S</p>
                <p onClick="addToCart(<?php echo $productId?>,'M','<?php echo $radioGroupId ?>', 1)">M</p>
                <p onClick="addToCart(<?php echo $productId?>,'L','<?php echo $radioGroupId ?>', 1)">L</p>
                <p onClick="addToCart(<?php echo $productId?>,'XL','<?php echo $radioGroupId ?>', 1)">XL</p>
                <p onClick="addToCart(<?php echo $productId?>,'XXL','<?php echo $radioGroupId ?>', 1)">XXL</p>
            </div>
        </button>
    </div>
</div>