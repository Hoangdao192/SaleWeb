<?php
    include "header.php";
    include "slider.php";
    
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/product_type_table.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/product_table.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/models/product.php";
?>
<?php 
    $product_table = new ProductTable;
    if (!isset($_GET[ProductTable::$COLUMN_PRODUCT_ID]) || $_GET[ProductTable::$COLUMN_PRODUCT_ID] == NULL) {
        echo "<script>window.location = 'cartegorylist.php'</script>";
    } else {
        $product_id = $_GET[ProductTable::$COLUMN_PRODUCT_ID];
    }
    $product = $product_table->get_product($product_id);
?>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $product_type_table = new ProductTypeTable;
        $product = new Product();
        $product->id = $product_id;
        $product->type_id = $_POST[ProductTable::$COLUMN_PRODUCT_TYPE_ID];
        $product->category_id = $product_type_table->get_product_type($product->type_id)->category_id;
        $product->name = $_POST[ProductTable::$COLUMN_PRODUCT_NAME];
        $product->color = $_POST[ProductTable::$COLUMN_PRODUCT_COLOR];
        $product->price = $_POST[ProductTable::$COLUMN_PRODUCT_PRICE];

        $product_table->update_product($product, $_FILES);
        header('Location:show_product.php');
    }
?>

<div class="admin-content-right">
            <div class="admin-content-right-cartegory-add">
                <h1 class="content-title">Sửa sản phẩm</h1>
                <form action="" method="POST" class="submit_form" enctype="multipart/form-data">
                    <select required name="<?php echo ProductTable::$COLUMN_PRODUCT_TYPE_ID?>" id="loaisp">
                        <option value="#">Chọn danh mục</option>
                        <?php
                            $product_type_table = new ProductTypeTable;
                            $product_types = $product_type_table->get_all();
                            for ($i = 0; $i < sizeof($product_types); ++$i) {
                                $product_type = $product_types[$i];
                        ?>
                                <option value="<?php echo $product_type->id?>"><?php echo $product_type->name?></option>
                        <?php
                            }
                        ?>
                    </select><br>
                    <input class="input-template" required name="<?php echo ProductTable::$COLUMN_PRODUCT_NAME?>" type="text" 
                        placeholder="Nhập tên sản phẩm" value="<?php echo $product->name?>"><br>
                    <input class="input-template" required name="<?php echo ProductTable::$COLUMN_PRODUCT_PRICE?>" type="number" 
                        placeholder="Nhập giá tiền" value="<?php echo $product->price?>"><br>
                    <input class="input-template" required name="<?php echo ProductTable::$COLUMN_PRODUCT_COLOR?>" type="text" 
                        placeholder="Nhập tên màu" value="<?php
                                $color_string = "";
                                for ($j = 0; $j < sizeof($product->color); ++$j) {
                                    if (strlen($color_string) >= 30) break;
                                    if ($j > 0) $color_string .= "; ";
                                    $color_string .= $product->color[$j];
                                }
                                echo $color_string;
                            ?>">
                    <br>
                    <input type="file" required name="<?php echo ProductTable::$COLUMN_PRODUCT_IMAGE_PATH?>" placeholder="Tải ảnh lên">
                    <button class="button-template submitbtn" type="submit">Sửa</button>
                </form>
            </div>
        </div>
    </section>
</body>
<script>
    var selector = document.getElementById('loaisp');
    for(var i, j = 0; i = selector.options[j]; j++) {
        if(i.value == <?php echo $product->type_id?>) {
            selector.selectedIndex = j;
            break;
        }
    }

    var form = document.querySelector(".submit_form");
    var button = document.querySelector(".submitbtn");
    form.addEventListener("submit", function(e) {
        e.preventDefault();
        var value = selector.options[selector.selectedIndex].value;
        if (value != "#") {
            console.log("yes");
            form.submit();
            form.reset();
            window.alert("đã");
        } else {
            window.alert("Chưa chọn loại sản phẩm");
        };
    })
</script>
</html>