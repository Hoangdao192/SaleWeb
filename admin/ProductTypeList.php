<?php
include "header.php";
include "slider.php";
include_once "ProductType.php";
?>

<?php
$productType = new ProductType;
$showProductType = $productType->show_product_type();
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
            if ($showProductType) {
                $i = 0;
                while ($result = $showProductType->fetch_assoc()) {
                    $i++;
                ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $result['id_loaisanpham']?></td>
                        <td><?php echo $result['id_danhmuc']?></td>
                        <td><?php echo $result['ten_loaisanpham']?></td>
                        <td><a href="ProductTypeEdit.php?id_loaisanpham=<?php echo $result['id_loaisanpham']?>">Sửa</a>|<a href="ProductTypeDelete.php?id_loaisanpham=<?php echo $result['id_loaisanpham']?>">Xóa</a></td>
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