<?php
    include "header.php";
    include "slider.php";
    include_once "Category.php"
?>
<?php 
    $category = new Category;
    if (!isset($_GET[$category->COLUMN_CATEGORY_ID]) || $_GET[$category->COLUMN_CATEGORY_ID] == NULL) {
        echo "<script>window.location = 'listcategory.php'</script>";
    } else {
        $categoryId = $_GET[$category->COLUMN_CATEGORY_ID];
    }
    $getCategory = $category->get_category($categoryId);
    if ($getCategory) {
        $categoryResult = $getCategory->fetch_assoc();
    }
?>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $ten_danhmuc = $_POST[$category->COLUMN_CATEGORY_NAME];
        $insertCategory = $category->update_category($categoryId, $ten_danhmuc);
        header('Location:CategoryList.php');
    }
?>

<div class="admin-content-right">
            <div class="admin-content-right-cartegory-add">
                <h1 class="content-title">Sửa danh mục</h1>
                <form action="" method="POST" class="submit_form">
                    <input class="input-template" required name="<?php echo $category->COLUMN_CATEGORY_NAME?>" type="text" placeholder="Nhập tên danh mục" value="<?php echo $categoryResult[$category->COLUMN_CATEGORY_NAME]?>">
                    <button class="button-template submitbtn" type="submit">Sửa</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>