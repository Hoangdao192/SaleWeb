<?php
    include "header.php";
    include "slider.php";
    include "Product.php";
    include_once "ProductType.php"
?>

<?php
    $product = new Product;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_loaisanpham = $_POST['id_loaisanpham'];
        $ten_sanpham = $_POST['ten_sanpham'];
        $mau = $_POST['mau'];
        $giatien = $_POST['giatien'];
        $hinhanh = $_POST['hinhanh'];
        $insert_product = $product->insert_product(
            $id_loaisanpham, 
            $ten_sanpham,
            $mau, 
            $giatien,
            $hinhanh
        );
    }
?>

<div class="admin-content-right">
            <div class="admin-content-right-cartegory-add">
                <h1 class="content-title">Thêm sản phẩm</h1>
                <form action="" method="POST" class="submit_form">
                    <select required name="id_loaisanpham" id="loaisp">
                        <option value="#">Chọn loại sản phẩm</option>
                        <?php
                        $productType = new ProductType;
                        $showProductType = $productType->show_product_type();
                        if ($showProductType) {
                            while ($result = $showProductType->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $result['id_loaisanpham']?>"><?php echo $result['ten_loaisanpham']?></option>
                        <?php
                            }
                        }
                        ?>
                    </select><br>
                    <input class="input-template" required name="ten_sanpham" type="text" placeholder="Nhập tên sản phẩm"><br>
                    <input class="input-template" required name="giatien" type="number" placeholder="Nhập giá tiền"><br>
                    <input class="input-template" required name="mau" type="text" placeholder="Nhập tên màu"><br>
                    <input class="input-template" required name="hinhanh" type="text" placeholder="Nhập đường dẫn hình ảnh">
                    <button class="button-template submitbtn" type="submit">Thêm</button>
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
        var selector = document.getElementById('loaisp');
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