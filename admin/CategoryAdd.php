<?php
    include "header.php";
    include "slider.php";
    include_once "Category.php"
?>

<?php
    $category = new category;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $ten_danhmuc = $_POST['ten_danhmuc'];
        $insert_category = $category->insert_category($ten_danhmuc);
    }
?>

<div class="admin-content-right">
            <div class="admin-content-right-cartegory-add">
                <h1>Thêm danh mục</h1>
                <form action="" method="POST">
                    <input required name="ten_danhmuc" type="text" placeholder="Nhập tên danh mục">
                    <button type="submit">Thêm</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>