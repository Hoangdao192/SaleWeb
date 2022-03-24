<?php
include "header.php";
include "slider.php";
include_once "ProductType.php";
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
        <table>
            <tr>
                <th>STT</th>
                <th>ID</th>
                <th>ID danh mục</th>
                <th>Tên loại sản phẩm</th>
                <th>Tùy chọn</th>
            </tr>
            <?php
            $showProductType = $productType->show_product_type();
            if ($showProductType) {
                $i = 0;
                while ($result = $showProductType->fetch_assoc()) {
                    $i++;
                ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $result[$columnProductTypeIdTitle]?></td>
                        <td><?php echo $result[$columnCategoryIdTitle]?></td>
                        <td><?php echo $result[$columnProductTypeNameTitle]?></td>
                        <td><a href="ProductTypeEdit.php?<?php echo $columnProductTypeIdTitle?>=<?php echo $result[$columnProductTypeIdTitle]?>">Sửa</a>
                            |<a href="ProductTypeDelete.php?<?php echo $columnProductTypeIdTitle?>=<?php echo $result[$columnProductTypeIdTitle]?>">Xóa</a>
                        </td>
                    </tr>
                <?php
                }
            }
            ?>
        </table>
    </div>
</div>
</section>
</body>
</html>