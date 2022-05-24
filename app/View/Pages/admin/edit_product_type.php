<?php
use App\Database\DAO\CategoryDAO;
use App\Database\DAO\ProductTypeDAO;
use Core\HTML;

$categories = $data['categories'];
$productType = $data['productType'];
?>

<div class="admin-content-right">
            <div class="admin-content-right-cartegory-add">
                <h1 class="content-title">Sửa loại sản phẩm</h1>
                <form action="<?php echo HTML::getUrl("admin/updateproducttype")?>" method="POST" class="submit_form">
                    <input type="hidden" name="<?php echo ProductTypeDAO::$COL_PRODUCT_TYPE_ID?>" value="<?php echo $productType->id?>">
                    <select name="<?php echo CategoryDAO::$COL_CATEGORY_ID?>" id="danhmuc">
                        <option value="#">Chọn danh mục</option>
                        <?php
                        for ($i = 0; $i < sizeof($categories); $i++){
                            $category = $categories[$i];
                        ?>
                            <option value="<?php echo $category->id?>"><?php echo $category->name?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <br>
                    <input class="input-template" required name="<?php echo ProductTypeDAO::$COL_PRODUCT_TYPE_NAME?>" 
                        type="text" placeholder="Nhập tên loại sản phẩm" value="<?php echo $productType->name?>">
                    <button type="button-template submit" class="submitbtn">Sửa</button>
                </form>
            </div>
        </div>
    </section>
</body>

<script>
    var selector = document.getElementById('danhmuc');
    //  Đặt giá trị hiện tại cho selector
    for(var i, j = 0; i = selector.options[j]; j++) {
        if(i.value == <?php echo $productType->categoryId?>) {
            selector.selectedIndex = j;
            break;
        }
    }
</script>
</html>