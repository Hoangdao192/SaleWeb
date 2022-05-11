<?php
    include "header.php";
    include "slider.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/CategoryTable.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/models/Category.php";
?>
<?php 
    $categoryTable = new CategoryTable;
    $categoryId;
    if (!isset($_GET[CategoryTable::$COL_CATEGORY_ID]) || $_GET[CategoryTable::$COL_CATEGORY_ID] == NULL) {
        echo "<script>window.location = 'show_category.php'</script>";
    } else {
        $categoryId = $_GET[CategoryTable::$COL_CATEGORY_ID];
    }
    $category = $categoryTable->getCategory($categoryId);
?>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $categoryName = $_POST[CategoryTable::$COL_CATEGORY_NAME];
        $newCategory = new Category;
        $newCategory->id = $categoryId;
        $newCategory->name = $categoryName;
        $categoryTable->updateCategory($newCategory);
        header('Location:show_category.php');
    }
?>

<div class="admin-content-right">
            <div class="admin-content-right-cartegory-add">
                <h1 class="content-title">Sửa danh mục</h1>
                <form action="" method="POST" class="submit_form">
                    <input class="input-template" required name="<?php echo CategoryTable::$COL_CATEGORY_NAME?>" 
                        type="text" placeholder="Nhập tên danh mục" value="<?php echo $category->name?>">
                    <button class="button-template submitbtn" type="submit">Sửa</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>