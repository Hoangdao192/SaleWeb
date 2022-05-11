<?php
include "header.php";
include "slider.php";

include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/ProductTable.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/ProductTypeTable.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/CategoryTable.php";
?>

<?php
$product_table = new ProductTable;
$products = $product_table->getAll();
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
                        $productTypeId = $product->typeId;
                        $productTypeTable = new ProductTypeTable;
                        $productType = $productTypeTable->getProductType($productTypeId);

                        $categoryId = $productType->categoryId;
                        $categoryTable = new CategoryTable;
                        $category = $categoryTable->getCategory($categoryId);

                ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $product->id ?></td>
                            <td><?php echo $category->name?></td>
                            <td><?php echo $productType->name?></td>
                            <td><?php echo $product->name ?></td>
                            <td>
                                <?php
                                    $colorString = "";
                                    for ($j = 0; $j < sizeof($product->color); ++$j) {
                                        if (strlen($colorString) >= 30) break;
                                        if ($j > 0) $colorString .= "; ";
                                        $colorString .= $product->color[$j];
                                    }
                                    echo $colorString;
                                ?>
                            </td>
                            <td><?php echo number_format($product->price, 0, ',', '.')?>đ</td>
                            <td><?php echo $product->imagePath ?></td>
                            <td><a href="edit_product.php?<?php echo ProductTable::$COL_PRODUCT_ID?>=<?php echo $product->id ?>">Sửa</a>|
                                <a href="delete_product.php?<?php echo ProductTable::$COL_PRODUCT_ID?>=<?php echo $product->id ?>">Xóa</a>
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