<?php
include "header.php";
include "slider.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/product_type_table.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/category_table.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/models/product_type.php";
?>

<?php
$product_type_table = new ProductTypeTable;
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
                $product_types = $product_type_table->get_all();
                for ($i = 0; $i < sizeof($product_types); $i++) {
                    $product_type = $product_types[$i];

                    $category_id = $product_type->category_id;
                    $category_table = new CategoryTable;
                    $category = $category_table->get_category($category_id);
                ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $product_type->id ?></td>
                        <td><?php echo $category->name ?></td>
                        <td><?php echo $product_type->name ?></td>
                        <td><a href="ProductTypeEdit.php?<?php echo ProductTypeTable::$COLUMN_PRODUCT_TYPE_ID?>=<?php echo $product_type->id?>">Sửa</a>
                            |<a href="ProductTypeDelete.php?<?php echo ProductTypeTable::$COLUMN_PRODUCT_TYPE_ID?>=<?php echo $product_type->id?>">Xóa</a>
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