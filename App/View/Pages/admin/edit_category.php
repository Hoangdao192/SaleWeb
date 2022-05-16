<?php
use App\Database\DAO\CategoryDAO;

$category = $data['category'];
?>

<div class="admin-content-right">
            <div class="admin-content-right-cartegory-add">
                <h1 class="content-title">Sửa danh mục</h1>
                <form action="http://localhost/saleweb/admin/updatecategory" method="POST" class="submit_form">
                    <input type="hidden" name="<?php echo CategoryDAO::$COL_CATEGORY_ID?>" value="<?php echo $category->id?>">
                    <input class="input-template" required name="<?php echo CategoryDAO::$COL_CATEGORY_NAME?>" 
                        type="text" placeholder="Nhập tên danh mục" value="<?php echo $category->name?>">
                    <button class="button-template submitbtn" type="submit">Sửa</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>