<?php
include "header.php";
include "slider.php";

include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/product_table.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/product_type_table.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/category_table.php";
?>

<?php
$product_table = new ProductTable;
$products = $product_table->get_all();
?>

<div class="admin-content-right">
    <div class="admin-content-right-cartegory-list">
        <h1>Danh sách sản phẩm</h1>
        <table class="content-table">
            <thead class="table-head">
                <tr>
                    <th>STT</th>
                    <th>ID</th>
                    <th>Danh mục</th>
                    <th>Loại sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Màu</th>
                    <th>Giá tiền</th>
                    <th>Hình ảnh</th>
                    <th>Tùy biến</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($products) {
                    $i = 0;
                    for ($i = 0; $i < sizeof($products); ++$i) {
                        $product = $products[$i];
                        $product_type_id = $product->type_id;
                        $product_type_table = new ProductTypeTable;
                        $product_type = $product_type_table->get_product_type($product_type_id);

                        $category_id = $product_type->category_id;
                        $category_table = new CategoryTable;
                        $category = $category_table->get_category($category_id);

                ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $product->id ?></td>
                            <td><?php echo $category->name?></td>
                            <td><?php echo $product_type->name?></td>
                            <td><?php echo $product->name ?></td>
                            <td>
                                <?php
                                    $color_string = "";
                                    for ($j = 0; $j < sizeof($product->color); ++$j) {
                                        if (strlen($color_string) >= 30) break;
                                        if ($j > 0) $color_string .= "; ";
                                        $color_string .= $product->color[$j];
                                    }
                                    echo $color_string;
                                ?>
                            </td>
                            <td><?php echo $product->price ?></td>
                            <td><?php echo $product->image_path ?></td>
                            <td><a href="edit_product.php?<?php echo ProductTable::$COLUMN_PRODUCT_ID?>=<?php echo $product->id ?>">Sửa</a>|
                                <a href="delete_product.php?<?php echo ProductTable::$COLUMN_PRODUCT_ID?>=<?php echo $product->id ?>">Xóa</a>
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