<?php
use App\Database\DAO\CategoryDAO;
?>

<div class="admin-content-right">
    <div class="admin-content-right-cartegory-add">
        <h1 class="content-title">Thêm danh mục</h1>
        <form action="http://localhost/saleweb/admin/categoryinput" method="POST">
            <input class="input-template" required name="<?php echo CategoryDAO::$COL_CATEGORY_NAME ?>" type="text" placeholder="Nhập tên danh mục">
            <button class="button-template" type="submit">Thêm</button>
        </form>
    </div>
</div>