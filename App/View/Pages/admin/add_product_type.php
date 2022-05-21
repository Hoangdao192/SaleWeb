<?php
use App\Database\DAO\ProductTypeDAO;
use App\Database\DAO\CategoryDAO;
use Core\HTML;

$categories = $data['categories'];
?>

<div class="admin-content-right">
    <div class="admin-content-right-cartegory-add">
        <h1 class="content-title">Thêm loại sản phẩm</h1>
        <form action="<?php echo HTML::getUrl("admin/producttypeinput")?>" method="POST" class="submit_form">
            <select name="<?php echo CategoryDAO::$COL_CATEGORY_ID ?>" id="danhmuc">
                <option value="#">Chọn danh mục</option>
                <?php
                for ($i = 0; $i < sizeof($categories); ++$i) {
                    $category = $categories[$i];
                ?>
                    <option value="<?php echo $category->id ?>">
                        <?php echo $category->name ?>
                    </option>
                <?php
                }
                ?>
            </select>
            <br>
            <input class="input-template" required name="<?php echo ProductTypeDAO::$COL_PRODUCT_TYPE_NAME ?>" type="text" placeholder="Nhập tên loại sản phẩm">
            <button type="button-temmplate submit" class="submitbtn">Thêm</button>
        </form>
    </div>
</div>
</html>