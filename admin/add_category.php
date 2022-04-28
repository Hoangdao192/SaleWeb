<?php
    include "header.php";
    include "slider.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/category_table.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/models/category.php";
?>

<?php
    $category_table = new CategoryTable;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $category = new Category;
        $category->name = $_POST[CategoryTable::$COLUMN_CATEGORY_NAME];
        $category_table->insert_category($category);
    }
?>

<div class="admin-content-right">
            <div class="admin-content-right-cartegory-add">
                <h1 class="content-title">Thêm danh mục</h1>
                <form action="" method="POST">
                    <input class="input-template" required name="<?php echo CategoryTable::$COLUMN_CATEGORY_NAME?>" type="text" placeholder="Nhập tên danh mục">
                    <button class="button-template" type="submit">Thêm</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>