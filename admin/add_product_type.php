<?php
    include "header.php";
    include "slider.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/product_type_table.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/category_table.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/models/product_type.php";
?>

<?php
    $category_table = new CategoryTable;
    $product_type_table = new ProductTypeTable;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $category_id = $_POST[CategoryTable::$COLUMN_CATEGORY_ID];
        $product_type_name = $_POST[ProductTypeTable::$COLUMN_PRODUCT_TYPE_NAME];
        $product_type = new ProductType;
        $product_type->category_id = $category_id;
        $product_type->name = $product_type_name;
        $product_type_table->insert_product_type($product_type);
    }
?>

<div class="admin-content-right">
            <div class="admin-content-right-cartegory-add">
                <h1 class="content-title">Thêm loại sản phẩm</h1>
                <form action="" method="POST" class="submit_form">
                    <select name="<?php echo CategoryTable::$COLUMN_CATEGORY_ID?>" id="danhmuc">
                        <option value="#">Chọn danh mục</option>
                        <?php
                        $categories = $category_table->get_all();
                        for ($i = 0; $i < sizeof($categories); ++$i) {
                            $category = $categories[$i];
                        ?>
                        <option value="<?php echo $category->id?>">
                            <?php echo $category->name?>
                        </option>
                        <?php
                        }
                        ?>
                    </select>
                    <br>
                    <input class="input-template" required name="<?php echo ProductTypeTable::$COLUMN_PRODUCT_TYPE_NAME?>" 
                        type="text" placeholder="Nhập tên loại sản phẩm">
                    <button type="button-temmplate submit" class="submitbtn">Thêm</button>
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
        var selector = document.getElementById('danhmuc');
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