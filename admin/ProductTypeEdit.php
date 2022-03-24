<?php
    include "header.php";
    include "slider.php";
    include_once "ProductType.php";
    include_once "Category.php";
?>

<?php 
    //  Lấy id loại sản phẩm được truyền đến
    $productType = new ProductType;
    $columnProductTypeIdTitle = $productType->COLUMN_PRODUCT_TYPE_ID;
    $columnProductTypeNameTitle = $productType->COLUMN_PRODUCT_TYPE_NAME;

    $category = new category;
    $columnCategoryIdTitle = $category->COLUMN_CATEGORY_ID;
    $columnCategoryNameTitle = $category->COLUMN_CATEGORY_NAME;
    $showCategory = $category->show_category();

    if (!isset($_GET[$columnProductTypeIdTitle]) || $_GET[$columnProductTypeIdTitle] == NULL) {
        echo "Không nhận được id loại sản phẩm";
        return;
    } else {
        $productTypeId = $_GET[$columnProductTypeIdTitle];
    }
    $getProductType = $productType->get_product_type($productTypeId);
    if ($getProductType) {
        $productTypeResult = $getProductType->fetch_assoc();
    }
?>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_danhmuc = $_POST[$columnCategoryIdTitle];
        $ten_loaisanpham = $_POST[$columnProductTypeNameTitle];
        $insertProductType = $productType->update_product_type($productTypeId, $id_danhmuc, $ten_loaisanpham);
        header('Location:ProductTypeList.php');
    }
?>

<div class="admin-content-right">
            <div class="admin-content-right-cartegory-add">
                <h1>Sửa loại sản phẩm</h1>
                <form action="" method="POST" class="submit_form">
                    <select name="<?php echo $columnCategoryIdTitle?>" id="danhmuc">
                        <option value="#">Chọn danh mục</option>
                        <?php
                            if ($showCategory) {
                                while ($result = $showCategory->fetch_assoc()) {
                            ?>
                        <option value="<?php echo $result[$columnCategoryIdTitle]?>"><?php echo $result[$columnCategoryNameTitle]?></option>
                        <?php
                                }
                            }
                        ?>
                        <option value=""></option>
                    </select>
                    <br>
                    <input class="input-template" required name="<? echo $columnProductTypeNameTitle?>" type="text" placeholder="Nhập tên loại sản phẩm" value="<?php echo $productTypeResult[$columnProductTypeNameTitle]?>">
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
        if(i.value == <?php echo $productTypeResult[$columnCategoryIdTitle]?>) {
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