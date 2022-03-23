<?php
include "header.php";
include "slider.php";
include "Product.php";
?>

<?php
$product = new Product;
$showProduct = $product->show_product();
?>

<div class="admin-content-right">
    <div class="admin-content-right-cartegory-list">
        <h1>Danh sách sản phẩm</h1>
        <table>
            <tr>
                <th>STT</th>
                <th>ID</th>
                <th>Loại sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Màu</th>
                <th>Giá tiền</th>
                <th>Hình ảnh</th>
                <th>Tùy biến</th>
            </tr>
            <?php
            if ($showProduct) {
                $i = 0;
                while ($result = $showProduct->fetch_assoc()) {
                    $i++;
                ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $result['id_sanpham']?></td>
                        <td><?php echo $result['id_loaisanpham']?></td>
                        <td><?php echo $result['ten_sanpham']?></td>
                        <td><?php echo $result['mau']?></td>
                        <td><?php echo $result['giatien']?></td>
                        <td><?php echo $result['hinhanh']?></td>
                        <td><a href="ProductEdit.php?id_sanpham=<?php echo $result['id_sanpham']?>">Sửa</a>|<a href="ProductDelete.php?id_sanpham=<?php echo $result['id_sanpham']?>">Xóa</a></td>
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