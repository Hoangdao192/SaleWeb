<?php
    include "header.php";
    include "slider.php";
    include_once "ProductType.php";
    include_once "Category.php";
?>

<?php 
    //  Lấy id loại sản phẩm được truyền đến
    $productType = new ProductType;
    if (!isset($_GET['id_loaisanpham']) || $_GET['id_loaisanpham'] == NULL) {
        echo "Không nhận được id loại sản phẩm";
        return;
    } else {
        $productTypeId = $_GET['id_loaisanpham'];
    }
    $getProductType = $productType->get_product_type($productTypeId);
    if ($getProductType) {
        $productTypeResult = $getProductType->fetch_assoc();
    }
?>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_danhmuc = $_POST['id_danhmuc'];
        $ten_loaisanpham = $_POST['ten_loaisanpham'];
        $insertProductType = $productType->update_product_type($productTypeId, $id_danhmuc, $ten_loaisanpham);
        header('Location:ProductTypeList.php');
    }
?>

<div class="admin-content-right">
            <div class="admin-content-right-cartegory-add">
                <h1>Sửa loại sản phẩm</h1>
                <form action="" method="POST" class="submit_form">
                    <select name="id_danhmuc" id="danhmuc">
                        <option value="#">Chọn danh mục</option>
                        <?php
                            $category = new category;
                            $showCategory = $category->show_category();
                            if ($showCategory) {
                                while ($result = $showCategory->fetch_assoc()) {
                            ?>
                        <option value="<?php echo $result['id_danhmuc']?>"><?php echo $result['ten_danhmuc']?></option>
                        <?php
                                }
                            }
                        ?>
                        <option value=""></option>
                    </select>
                    <br>
                    <input required name="ten_loaisanpham" type="text" placeholder="Nhập tên loại sản phẩm" value="<?php echo $productTypeResult['ten_loaisanpham']?>">
                    <button type="submit" class="submitbtn">Sửa</button>
                </form>
            </div>
        </div>
    </section>
</body>

<script>
    var selector = document.getElementById('danhmuc');
    //  Đặt giá trị hiện tại cho selector
    for(var i, j = 0; i = selector.options[j]; j++) {
        if(i.value == <?php echo $productTypeResult['id_danhmuc']?>) {
            selector.selectedIndex = j;
            break;
        }
    }

    var form = document.querySelector(".submit_form");
    var button = document.querySelector(".submitbtn");
    form.addEventListener("submit", function(e) {
        e.preventDefault();
        var value = selector.options[selector.selectedIndex].value;
        if (value != "#") {
            console.log("yes");
            form.submit();
            window.alert("đã");
        } else {
            window.alert("Chưa chọn loại sản phẩm");
        };
    })
</script>
</html>