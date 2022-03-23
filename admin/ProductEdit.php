<?php
    include "header.php";
    include "slider.php";
    include "Product.php";
    include "ProductType.php";
?>
<?php 
    $product = new Product;
    if (!isset($_GET['id_sanpham']) || $_GET['id_sanpham'] == NULL) {
        echo "<script>window.location = 'cartegorylist.php'</script>";
    } else {
        $productId = $_GET['id_sanpham'];
    }
    $getProduct = $product->get_product($productId);
    if ($getProduct) {
        $productResult = $getProduct->fetch_assoc();
    }
?>

<?php
    $product = new Product;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_loaisanpham = $_POST['id_loaisanpham'];
        $ten_sanpham = $_POST['ten_sanpham'];
        $mau = $_POST['mau'];
        $giatien = $_POST['giatien'];
        $hinhanh = $_POST['hinhanh'];
        $insertProduct = $product->update_product(
            $productId,
            $id_loaisanpham, 
            $ten_sanpham,
            $mau, 
            $giatien,
            $hinhanh
        );
        header('Location:ProductList.php');
    }
?>

<div class="admin-content-right">
            <div class="admin-content-right-cartegory-add">
                <h1>Sửa sản phẩm</h1>
                <form action="" method="POST" class="submit_form">
                    <select required name="id_loaisanpham" id="loaisp">
                        <option value="#">Chọn danh mục</option>
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
                    <input required name="ten_sanpham" type="text" placeholder="Nhập tên sản phẩm" value="<?php echo $productResult['ten_sanpham']?>"><br>
                    <input required name="giatien" type="number" placeholder="Nhập giá tiền" value="<?php echo $productResult['giatien']?>"><br>
                    <input required name="mau" type="text" placeholder="Nhập tên màu" value="<?php echo $productResult['mau']?>"><br>
                    <input required name="hinhanh" type="text" placeholder="Nhập đường dẫn hình ảnh" value="<?php echo $productResult['hinhanh']?>">
                    <button class="submitbtn" type="submit">Sửa</button>
                </form>
            </div>
        </div>
    </section>
</body>
<script>
    var selector = document.getElementById('loaisp');
    for(var i, j = 0; i = selector.options[j]; j++) {
        if(i.value == <?php echo $productResult['id_loaisanpham']?>) {
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
            form.reset();
            window.alert("đã");
        } else {
            window.alert("Chưa chọn loại sản phẩm");
        };
    })
</script>
</html>