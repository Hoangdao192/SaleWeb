<?php
include "header.php";
include "slider.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/category_table.php";
?>

<div class="admin-content-right">
    <div class="admin-content-right-cartegory-list">
        <h1 class="content-title">Danh sách danh mục</h1>
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
                $category_table = new CategoryTable;
                $categories = $category_table->get_all();
                for ($i = 0; $i < sizeof($categories); $i++) {
                    $category = $categories[$i];
                ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $category->id ?></td>
                        <td><?php echo $category->name ?></td>
                        <td><a href="CategoryEdit.php?<?php echo CategoryTable::$COLUMN_CATEGORY_ID ?>=<?php echo $category->id ?>">Sửa</a>
                            |<a href="CategoryDelete.php?<?php echo CategoryTable::$COLUMN_CATEGORY_ID ?>=<?php echo $category->id ?>">Xóa</a>
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