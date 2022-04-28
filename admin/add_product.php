<?php
    include "header.php";
    include "slider.php";    
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/models/product.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/product_type_table.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/product_table.php";
?>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $product_table = new ProductTable;
        $product_type_table = new ProductTypeTable;

        $product = new Product();
        $product->type_id = $_POST[ProductTable::$COLUMN_PRODUCT_TYPE_ID];
        $product->category_id = $product_type_table->get_product_type($product->type_id)->category_id;
        $product->name = $_POST[ProductTable::$COLUMN_PRODUCT_NAME];
        $product->color = $_POST[ProductTable::$COLUMN_PRODUCT_COLOR];
        $product->price = $_POST[ProductTable::$COLUMN_PRODUCT_PRICE];

        $product_table->insert_product($product, $_FILES);
    }
?>

<div class="admin-content-right">
            <div class="admin-content-right-cartegory-add">
                <h1 class="content-title">Thêm sản phẩm</h1>
                <form action="" method="POST" enctype="multipart/form-data" class="submit_form">
                    <select required name="<?php echo ProductTable::$COLUMN_PRODUCT_TYPE_ID?>" id="loaisp">
                        <option value="#">Chọn loại sản phẩm</option>
                        <?php
                        $product_type_table = new ProductTypeTable;
                        $product_types = $product_type_table->get_all();
                        for ($i = 0; $i < sizeof($product_types); $i++) {
                            $product_type = $product_types[$i];
                        ?>
                            <option value="<?php echo $product_type->id?>"><?php echo $product_type->name?></option>
                        <?php
                        }
                        ?>
                    </select><br>
                    <input class="input-template" required name="<?php echo ProductTable::$COLUMN_PRODUCT_NAME?>" 
                        type="text" placeholder="Nhập tên sản phẩm"><br>
                    <input class="input-template" required name="<?php echo ProductTable::$COLUMN_PRODUCT_PRICE?>" 
                        type="number" placeholder="Nhập giá tiền"><br>
                    <input class="input-template" required name="<?php echo ProductTable::$COLUMN_PRODUCT_COLOR?>" 
                        type="text" placeholder="Nhập tên màu"><br>
                    <input type="file" required name="<?php echo ProductTable::$COLUMN_PRODUCT_IMAGE_PATH?>" 
                        placeholder="Tải ảnh lên">
                    <button class="button-template submitbtn" type="submit">Thêm</button>
                </form>
            </div>
        </div>
    </section>
</body>
<script>
    var form = document.querySelector(".submit_form");
    var button = document.querySelector(".submitbtn");
    form.addEventListener("submit", function(e) {
        e.preventDefault();
        var selector = document.getElementById('loaisp');
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