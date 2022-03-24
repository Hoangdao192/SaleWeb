<?php
    include "header.php";
    include "slider.php";
    include_once "ProductType.php";
    include_once "Category.php";
?>

<?php
    $category = new Category;
    $columnIdTitle = $category->COLUMN_CATEGORY_ID;
    $columnNameTitle = $category->COLUMN_CATEGORY_NAME;

    $productType = new ProductType;
    $columnProductTypeNameTitle = $productType->COLUMN_PRODUCT_TYPE_NAME;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $categoryId = $_POST[$columnIdTitle];
        $productTypeName = $_POST[$productType->COLUMN_PRODUCT_TYPE_NAME];
        $insertProductType = $productType->insert_product_type($categoryId, $productTypeName);
    }
?>

<div class="admin-content-right">
            <div class="admin-content-right-cartegory-add">
                <h1>Thêm loại sản phẩm</h1>
                <form action="" method="POST" class="submit_form">
                    <select name="<?php echo $columnIdTitle?>" id="danhmuc">
                        <option value="#">Chọn danh mục</option>
                        <?php
                        $showCategory = $category->show_category();
                        if ($showCategory) {
                            while ($result = $showCategory->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $result[$columnIdTitle]?>">
                            <?php echo $result[$columnNameTitle]?>
                        </option>
                        <?php
                            }
                        }
                        ?>
                        <option value=""></option>
                    </select>
                    <br>
                    <input required name="<?php echo $columnProductTypeNameTitle?>" type="text" placeholder="Nhập tên loại sản phẩm">
                    <button type="submit" class="submitbtn">Thêm</button>
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