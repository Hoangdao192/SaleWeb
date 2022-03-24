<?php
include "header.php";
include "slider.php";
include_once "Category.php";
?>

<div class="admin-content-right">
    <div class="admin-content-right-cartegory-list">
        <h1>Danh sách danh mục</h1>
        <table class="content-table">
            <thead class="table-head">
                <tr>
                    <th>STT</th>
                    <th>ID</th>
                    <th>Tên danh mục</th>
                    <th>Tùy chọn</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $category = new Category;
                $showCategory = $category->show_category();
                if ($showCategory) {
                    $i = 0;
                    while ($result = $showCategory->fetch_assoc()) {
                        $i++;
                ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $result[$category->COLUMN_CATEGORY_ID] ?></td>
                            <td><?php echo $result[$category->COLUMN_CATEGORY_NAME] ?></td>
                            <td><a href="CategoryEdit.php?<?php echo $category->COLUMN_CATEGORY_ID ?>=<?php echo $result[$category->COLUMN_CATEGORY_ID] ?>">Sửa</a>
                                |<a href="CategoryDelete.php?<?php echo $category->COLUMN_CATEGORY_ID ?>=<?php echo $result[$category->COLUMN_CATEGORY_ID] ?>">Xóa</a>
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