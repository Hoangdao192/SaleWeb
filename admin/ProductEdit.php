<?php
    include "header.php";
    include "slider.php";
    include "Product.php";
    include "ProductType.php";
?>
<?php 
    $product = new Product;
    if (!isset($_GET['productId']) || $_GET['productId'] == NULL) {
        echo "<script>window.location = 'cartegorylist.php'</script>";
    } else {
        $productId = $_GET['productId'];
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
        $insertProduct = $product->update_product(
            $productId,
            $id_loaisanpham, 
            $ten_sanpham,
            $mau, 
            $giatien,
            $_FILES
        );
        header('Location:ProductList.php');
    }
?>

<div class="admin-content-right">
            <div class="admin-content-right-cartegory-add">
                <h1 class="content-title">Sửa sản phẩm</h1>
                <form action="" method="POST" class="submit_form" enctype="multipart/form-data">
                    <select required name="id_loaisanpham" id="loaisp">
                        <option value="#">Chọn danh mục</option>
                        <?php
                            $productType = new ProductType;
                            $showProductType = $productType->show_product_type();
                            if ($showProductType) {
                                while ($result = $showProductType->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $result['productTypeId']?>"><?php echo $result['productTypeName']?></option>
                        <?php
                                }
                            }
                        ?>
                    </select><br>
                    <input class="input-template" required name="ten_sanpham" type="text" placeholder="Nhập tên sản phẩm" value="<?php echo $productResult['productName']?>"><br>
                    <input class="input-template" required name="giatien" type="number" placeholder="Nhập giá tiền" value="<?php echo $productResult['productPrice']?>"><br>
                    <input class="input-template" required name="mau" type="text" placeholder="Nhập tên màu" value="<?php echo $productResult['productColor']?>"><br>
                    <input type="file" required name="productImage" placeholder="Tải ảnh lên">
                    <button class="button-template submitbtn" type="submit">Sửa</button>
                </form>
            </div>
        </div>
    </section>
</body>
<script>
    var selector = document.getElementById('loaisp');
    for(var i, j = 0; i = selector.options[j]; j++) {
        if(i.value == <?php echo $productResult['productTypeId']?>) {
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