<?php
    include "header.php";
    include "slider.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/category_table.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/models/category.php";
?>
<?php 
    $category_table = new CategoryTable;
    $category_id;
    if (!isset($_GET[CategoryTable::$COLUMN_CATEGORY_ID]) || $_GET[CategoryTable::$COLUMN_CATEGORY_ID] == NULL) {
        echo "<script>window.location = 'listcategory.php'</script>";
    } else {
        $category_id = $_GET[CategoryTable::$COLUMN_CATEGORY_ID];
    }
    $category = $category_table->get_category($category_id);
?>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $category_name = $_POST[CategoryTable::$COLUMN_CATEGORY_NAME];
        $new_category = new Category;
        $new_category->id = $category_id;
        $new_category->name = $category_name;
        $category_table->update_category($new_category);
        header('Location:CategoryList.php');
    }
?>

<div class="admin-content-right">
            <div class="admin-content-right-cartegory-add">
                <h1 class="content-title">Sửa danh mục</h1>
                <form action="" method="POST" class="submit_form">
                    <input class="input-template" required name="<?php echo CategoryTable::$COLUMN_CATEGORY_NAME?>" 
                        type="text" placeholder="Nhập tên danh mục" value="<?php echo $category->name?>">
                    <button class="button-template submitbtn" type="submit">Sửa</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>