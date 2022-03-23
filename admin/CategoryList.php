<?php
include "header.php";
include "slider.php";
include_once "Category.php";
?>

<?php
$category = new Category;
$showCategory = $category->show_category();
?>

<div class="admin-content-right">
    <div class="admin-content-right-cartegory-list">
        <h1>Danh sách danh mục</h1>
        <table>
            <tr>
                <th>STT</th>
                <th>ID</th>
                <th>Tên danh mục</th>
                <th>Tùy chọn</th>
            </tr>
            <?php
            if ($showCategory) {
                $i = 0;
                while ($result = $showCategory->fetch_assoc()) {
                    $i++;
                ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $result['id_danhmuc']?></td>
                        <td><?php echo $result['ten_danhmuc']?></td>
                        <td><a href="CategoryEdit.php?id_danhmuc=<?php echo $result['id_danhmuc']?>">Sửa</a>|<a href="CategoryDelete.php?id_danhmuc=<?php echo $result['id_danhmuc']?>">Xóa</a></td>
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