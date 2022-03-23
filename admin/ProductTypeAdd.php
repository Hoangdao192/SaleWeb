<?php
    include "header.php";
    include "slider.php";
    include_once "ProductType.php";
    include_once "Category.php";
?>

<?php
    $category = new Category;
    $productType = new ProductType;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_danhmuc = $_POST['id_danhmuc'];
        $ten_loaisanpham = $_POST['ten_loaisanpham'];
        $insertProductType = $productType->insert_product_type($id_danhmuc, $ten_loaisanpham);
    }
?>

<div class="admin-content-right">
            <div class="admin-content-right-cartegory-add">
                <h1>Thêm loại sản phẩm</h1>
                <form action="" method="POST" class="submit_form">
                    <select name="id_danhmuc" id="danhmuc">
                        <option value="#">Chọn danh mục</option>
                        <?php
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
                    <input required name="ten_loaisanpham" type="text" placeholder="Nhập tên loại sản phẩm">
                    <button type="submit" class="submitbtn">Thêm</button>
                </form>
            </div>
        </div>
    </section>
</body>

<script>
    var form = document.querySelector(".submit_form");
    var button = document.querySelector(".submitbtn");
    form.addEventListener("submit", function(e) {
        e.preventDefault();
        var selector = document.getElementById('danhmuc');
        var value = selector.options[selector.selectedIndex].value;
        if (value != "#") {
            console.log("yes");
            form.submit();
            form.reset();
            window.alert("đã");
        } else {
            window.alert("Chưa chọn loại sản phẩm");
        };
    })
</script>

</html>