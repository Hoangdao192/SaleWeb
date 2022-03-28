<?php
include "header.php";
include "slider.php";
include_once "ProductType.php";
include_once "Category.php"
?>

<?php
$productType = new ProductType;
$columnProductTypeIdTitle = $productType->COLUMN_PRODUCT_TYPE_ID;
$columnCategoryIdTitle = $productType->COLUMN_CATEGORY_ID;
$columnProductTypeNameTitle = $productType->COLUMN_PRODUCT_TYPE_NAME;
?>

<div class="admin-content-right">
    <div class="admin-content-right-cartegory-list">
        <h1>Danh sách loại sản phẩm</h1>
        <table class="content-table">
            <thead class="table-head">
                <tr>
                    <th>STT</th>
                    <th>ID</th>
                    <th>Danh mục</th>
                    <th>Tên loại sản phẩm</th>
                    <th>Tùy chọn</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $showProductType = $productType->show_product_type();
                if ($showProductType) {
                    $i = 0;
                    while ($result = $showProductType->fetch_assoc()) {
                        $i++;
                        $categoryId = $result[$columnCategoryIdTitle];
                        $category = new Category;
                        $thisCategory = $category->get_category($categoryId)->fetch_assoc();
                ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $result[$columnProductTypeIdTitle] ?></td>
                            <td><?php echo $thisCategory[$category->COLUMN_CATEGORY_NAME] ?></td>
                            <td><?php echo $result[$columnProductTypeNameTitle] ?></td>
                            <td><a href="ProductTypeEdit.php?<?php echo $columnProductTypeIdTitle ?>=<?php echo $result[$columnProductTypeIdTitle] ?>">Sửa</a>
                                |<a href="ProductTypeDelete.php?<?php echo $columnProductTypeIdTitle ?>=<?php echo $result[$columnProductTypeIdTitle] ?>">Xóa</a>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</section>
</body>

</html>