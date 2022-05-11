<?php
    include "header.php";
    include "slider.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/ProductTypeTable.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/CategoryTable.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/models/ProductType.php";
?>

<?php 
    //  Lấy id loại sản phẩm được truyền đến
    $productTypeTable = new ProductTypeTable;

    $categoryTable = new CategoryTable;

    $productTypeId;

    if (!isset($_GET[ProductTypeTable::$COL_PRODUCT_TYPE_ID]) || $_GET[ProductTypeTable::$COL_PRODUCT_TYPE_ID] == NULL) {
        echo "Không nhận được id loại sản phẩm";
        return;
    } else {
        $productTypeId = $_GET[ProductTypeTable::$COL_PRODUCT_TYPE_ID];
    }
    $productType = $productTypeTable->getProductType($productTypeId);
?>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $categoryId = $_POST[CategoryTable::$COL_CATEGORY_ID];
        $product_type_name = $_POST[ProductTypeTable::$COL_PRODUCT_TYPE_NAME];

        $productType = new ProductType;
        $productType->id = $productTypeId;
        $productType->categoryId = $categoryId;
        $productType->name = $product_type_name;
        $productTypeTable->updateProductType($productType);
        header('Location:show_product_type.php');
    }
?>

<div class="admin-content-right">
            <div class="admin-content-right-cartegory-add">
                <h1 class="content-title">Sửa loại sản phẩm</h1>
                <form action="" method="POST" class="submit_form">
                    <select name="<?php echo CategoryTable::$COL_CATEGORY_ID?>" id="danhmuc">
                        <option value="#">Chọn danh mục</option>
                        <?php
                        $categories = $categoryTable->getAll();
                        for ($i = 0; $i < sizeof($categories); $i++){
                            $category = $categories[$i];
                        ?>
                            <option value="<?php echo $category->id?>"><?php echo $category->name?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <br>
                    <input class="input-template" required name="<?php echo ProductTypeTable::$COL_PRODUCT_TYPE_NAME?>" 
                        type="text" placeholder="Nhập tên loại sản phẩm" value="<?php echo $productType->name?>">
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
        if(i.value == <?php echo $productType->categoryId?>) {
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