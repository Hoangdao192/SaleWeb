<?php
    include "header.php";
    include "slider.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/product_type_table.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/category_table.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/models/product_type.php";
?>

<?php 
    //  Lấy id loại sản phẩm được truyền đến
    $product_type_table = new ProductTypeTable;

    $category_table = new CategoryTable;

    $product_type_id;

    if (!isset($_GET[ProductTypeTable::$COLUMN_PRODUCT_TYPE_ID]) || $_GET[ProductTypeTable::$COLUMN_PRODUCT_TYPE_ID] == NULL) {
        echo "Không nhận được id loại sản phẩm";
        return;
    } else {
        $product_type_id = $_GET[ProductTypeTable::$COLUMN_PRODUCT_TYPE_ID];
    }
    $product_type = $product_type_table->get_product_type($product_type_id);
?>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $category_id = $_POST[CategoryTable::$COLUMN_CATEGORY_ID];
        $product_type_name = $_POST[ProductTypeTable::$COLUMN_PRODUCT_TYPE_NAME];

        $product_type = new ProductType;
        $product_type->id = $product_type_id;
        $product_type->category_id = $category_id;
        $product_type->name = $product_type_name;
        $product_type_table->update_product_type($product_type);
        header('Location:ProductTypeList.php');
    }
?>

<div class="admin-content-right">
            <div class="admin-content-right-cartegory-add">
                <h1 class="content-title">Sửa loại sản phẩm</h1>
                <form action="" method="POST" class="submit_form">
                    <select name="<?php echo CategoryTable::$COLUMN_CATEGORY_ID?>" id="danhmuc">
                        <option value="#">Chọn danh mục</option>
                        <?php
                        $categories = $category_table->get_all();
                        for ($i = 0; $i < sizeof($categories); $i++){
                            $category = $categories[$i];
                        ?>
                            <option value="<?php echo $category->id?>"><?php echo $category->name?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <br>
                    <input class="input-template" required name="<?php echo ProductTypeTable::$COLUMN_PRODUCT_TYPE_NAME?>" 
                        type="text" placeholder="Nhập tên loại sản phẩm" value="<?php echo $product_type->name?>">
                    <button type="button-template submit" class="submitbtn">Sửa</button>
                </form>
            </div>
        </div>
    </section>
</body>

<script>
    var selector = document.getElementById('danhmuc');
    //  Đặt giá trị hiện tại cho selector
    for(var i, j = 0; i = selector.options[j]; j++) {
        if(i.value == <?php echo $product_type->category_id?>) {
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
            window.alert("đã");
        } else {
            window.alert("Chưa chọn loại sản phẩm");
        };
    })
</script>
</html>