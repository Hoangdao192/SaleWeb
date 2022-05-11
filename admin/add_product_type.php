<?php
    include "header.php";
    include "slider.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/ProductTypeTable.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/CategoryTable.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/models/ProductType.php";
?>

<?php
    $categoryTable = new CategoryTable;
    $productTypeTable = new ProductTypeTable;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $categoryId = $_POST[CategoryTable::$COL_CATEGORY_ID];
        $productTypeName = $_POST[ProductTypeTable::$COL_PRODUCT_TYPE_NAME];
        $productType = new ProductType;
        $productType->categoryId = $categoryId;
        $productType->name = $productTypeName;
        $productTypeTable->insertProductType($productType);
    }
?>

<div class="admin-content-right">
            <div class="admin-content-right-cartegory-add">
                <h1 class="content-title">Thêm loại sản phẩm</h1>
                <form action="" method="POST" class="submit_form">
                    <select name="<?php echo CategoryTable::$COL_CATEGORY_ID?>" id="danhmuc">
                        <option value="#">Chọn danh mục</option>
                        <?php
                        $categories = $categoryTable->getAll();
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
                    <input class="input-template" required name="<?php echo ProductTypeTable::$COL_PRODUCT_TYPE_NAME?>" 
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