<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/product_table.php";
    //  This file take data from database and return it in HTML

    $product_table = new ProductTable;

    if (isset($_GET['id'])) {
        $categoryId = $_GET['id'];
        $products = $product_table->get_all_filter_by_category($categoryId);
        showDataToHTML($products, 1);
        exit();
    }

    if (isset($_GET['productTypeId'])) {
        $productTypeId = $_GET['productTypeId'];
        $page = $_GET['page'];
        $products = $product_table->get_all_filter_by_type($productTypeId);
        showDataToHTML($products, $page);
        exit();
    }

    //  Show data in HTML
    //  Data is mysqli querry result
    function showDataToHTML($products, $page) {
        if ($products) {
            $j = ($page - 1) * 12;

            for ($i = 0; $i < sizeof($products); ++$i) {
                $product = $products[$i];
                $j++;
                if ($j > 9) break;
                $divProductItemStyle = "";
                $radio_group_id = "product-color" . $product->id;
                if (fmod($j,3) != 0 || $j == 0) {
                    $divProductItemStyle = "margin-right:4.7%";
                }
                ?>

                <div style="<?php echo $divProductItemStyle?>" class="product-item">
                <img onClick=showProductDetail(<?php echo $product->id?>) src="admin/database/<?php echo $product->image_path?>">
                <div id="<?php echo $radio_group_id?>" class="product-color">
                <?php
                $color_array = $product->color;

                for ($k = 0; $k < sizeof($color_array); $k++) {
                    $radio_button_name = "color" . $product->id;
                    $radio_button_id = "color" . $product->id . "-" . $k;
                    $radio_checked = "";
                    if ($k == 0) {
                        $radio_checked = "checked";
                    }
                    $border_class = "";
                    $black_check = "";
                    if ($color_array[$k] == '#FFFFFF') {
                        $border_class = " inner-border";
                        $black_check = " black";
                    }
                    ?>
                    <div class="product-color-item">
                    <input value="<?php echo $color_array[$k]?>" type="radio" class="radio" name="<?php echo $radio_button_name?>" <?php echo $radio_checked?> id="<?php echo $radio_button_id?>">
                    <label style="background-color:<?php echo $color_array[$k]?>" for="<?php echo $radio_button_id?>" class="radio-label<?php echo $border_class?>">
                    <i class="fa-xs fa-solid fa-check<?php echo $black_check?>"></i>
                    </label>
                    </div>
                <?php
                }
                ?>           
                </div>
                <p class="product-name"><?php echo $product->name?></p>
                <p class="product-price"><?php echo number_format($product->price, 0, ',', '.')?><span>đ</span></p>
                <input style="display: none;" class="product-id-input" name="productId" value="<?php echo $product->id?>"/>
                <input style="display: none;" type="text" name="insert" value="insert"/>
                    <button class="add-to-cart">
                        <i class="fa-xl fa-thin fa-plus"></i>
                        <div class="product-size-sub-menu">
                            <p onClick="addToCart(<?php echo $product->id?>,'S','<?php echo $radio_group_id?>')">S</p>
                            <p onClick="addToCart(<?php echo $product->id?>,'M','<?php echo $radio_group_id?>')">M</p>
                            <p onClick="addToCart(<?php echo $product->id?>,'L','<?php echo $radio_group_id?>')">L</p>
                            <p onClick="addToCart(<?php echo $product->id?>,'XL','<?php echo $radio_group_id?>')">XL</p>
                            <p onClick="addToCart(<?php echo $product->id?>,'XXL','<?php echo $radio_group_id?>')">XXL</p>
                        </div>
                    </button>
                </div>
            <?php
            }
        }
    }
?>
