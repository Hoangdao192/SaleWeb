<?php
    include "header.php";
    include "slider.php";
    include_once "Category.php"
?>
<?php 
    $category = new Category;
    if (!isset($_GET['id_danhmuc']) || $_GET['id_danhmuc'] == NULL) {
        echo "<script>window.location = 'listcategory.php'</script>";
    } else {
        $categoryId = $_GET['id_danhmuc'];
    }
    $getCategory = $category->get_category($categoryId);
    if ($getCategory) {
        $categoryResult = $getCategory->fetch_assoc();
    }
?>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $ten_danhmuc = $_POST['ten_danhmuc'];
        $insertCategory = $category->update_category($categoryId, $ten_danhmuc);
        header('Location:CategoryList.php');
    }
?>

<div class="admin-content-right">
            <div class="admin-content-right-cartegory-add">
                <h1>Sửa danh mục</h1>
                <form action="" method="POST" class="submit_form">
                    <input required name="ten_danhmuc" type="text" placeholder="Nhập tên danh mục" value="<?php echo $categoryResult['ten_danhmuc']?>">
                    <button class="submitbtn" type="submit">Sửa</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>