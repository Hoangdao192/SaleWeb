<?php
    include "header.php";
    include "slider.php";
    include_once "Category.php"
?>

<?php
    $category = new category;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $categoryName = $_POST[$category->COLUMN_CATEGORY_NAME];
        $insertCategory = $category->insert_category($categoryName);
    }
?>

<div class="admin-content-right">
            <div class="admin-content-right-cartegory-add">
                <h1 class="content-title">Thêm danh mục</h1>
                <form action="" method="POST">
                    <input class="input-template" required name="<?php echo $category->COLUMN_CATEGORY_NAME?>" type="text" placeholder="Nhập tên danh mục">
                    <button class="button-template" type="submit">Thêm</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>