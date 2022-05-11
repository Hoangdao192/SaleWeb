<?php
include "header.php";
include "slider.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/ProductTypeTable.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/CategoryTable.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/models/ProductType.php";
?>

<?php
$productTypeTable = new ProductTypeTable;
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
                $productTypes = $productTypeTable->getAll();
                for ($i = 0; $i < sizeof($productTypes); $i++) {
                    $productType = $productTypes[$i];

                    $categoryId = $productType->categoryId;
                    $categoryTable = new CategoryTable;
                    $category = $categoryTable->getCategory($categoryId);
                ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $productType->id ?></td>
                        <td><?php echo $category->name ?></td>
                        <td><?php echo $productType->name ?></td>
                        <td><a href="edit_product_type.php?<?php echo ProductTypeTable::$COL_PRODUCT_TYPE_ID?>=<?php echo $productType->id?>">Sửa</a>
                            |<a href="delete_product_type.php?<?php echo ProductTypeTable::$COL_PRODUCT_TYPE_ID?>=<?php echo $productType->id?>">Xóa</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</section>
</body>

</html>