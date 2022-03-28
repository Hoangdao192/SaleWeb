<?php
include "header.php";
include "slider.php";
include_once "Product.php";
include_once "ProductType.php";
include_once "Category.php";
?>

<?php
$product = new Product;
$showProduct = $product->show_product();
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
                if ($showProduct) {
                    $i = 0;
                    while ($result = $showProduct->fetch_assoc()) {
                        $i++;
                        $productTypeId = $result['productTypeId'];
                        $productType = new ProductType;
                        $thisProductType = $productType->get_product_type($productTypeId)->fetch_assoc();

                        $categoryId = $thisProductType[$productType->COLUMN_CATEGORY_ID];
                        $category = new Category;
                        $thisCategory = $category->get_category($categoryId)->fetch_assoc();

                ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $result['productId'] ?></td>
                            <td><?php echo $thisCategory[$category->COLUMN_CATEGORY_NAME]?></td>
                            <td><?php echo $thisProductType[$productType->COLUMN_PRODUCT_TYPE_NAME]?></td>
                            <td><?php echo $result['productName'] ?></td>
                            <td><?php echo $result['productColor'] ?></td>
                            <td><?php echo $result['productPrice'] ?></td>
                            <td><?php echo $result['productImagePath'] ?></td>
                            <td><a href="ProductEdit.php?productId=<?php echo $result['productId'] ?>">Sửa</a>|<a href="ProductDelete.php?productId=<?php echo $result['productId'] ?>">Xóa</a></td>
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