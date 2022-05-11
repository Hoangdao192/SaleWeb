<?php
    include "header.php";
    include "slider.php";    
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/models/Product.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/ProductTypeTable.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/ProductTable.php";
?>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $productTable = new ProductTable;
        $productTypeTable = new ProductTypeTable;

        $product = new Product();
        $product->typeId = $_POST[ProductTable::$COL_PRODUCT_TYPE_ID];
        $product->categoryId = $productTypeTable->getProductType($product->typeId)->categoryId;
        $product->name = $_POST[ProductTable::$COL_PRODUCT_NAME];
        $product->color = $_POST[ProductTable::$COL_PRODUCT_COLOR];
        $product->price = $_POST[ProductTable::$COL_PRODUCT_PRICE];

        $productTable->insertProduct($product, $_FILES);
    }
?>

<div class="admin-content-right">
            <div class="admin-content-right-cartegory-add">
                <h1 class="content-title">Thêm sản phẩm</h1>
                <form action="" method="POST" enctype="multipart/form-data" class="submit_form">
                    <select required name="<?php echo ProductTable::$COL_PRODUCT_TYPE_ID?>" id="loaisp">
                        <option value="#">Chọn loại sản phẩm</option>
                        <?php
                        $productTypeTable = new ProductTypeTable;
                        $productTypes = $productTypeTable->getAll();
                        for ($i = 0; $i < sizeof($productTypes); $i++) {
                            $productType = $productTypes[$i];
                        ?>
                            <option value="<?php echo $productType->id?>"><?php echo $productType->name?></option>
                        <?php
                        }
                        ?>
                    </select><br>
                    <input class="input-template" required name="<?php echo ProductTable::$COL_PRODUCT_NAME?>" 
                        type="text" placeholder="Nhập tên sản phẩm"><br>
                    <input class="input-template" required name="<?php echo ProductTable::$COL_PRODUCT_PRICE?>" 
                        type="number" placeholder="Nhập giá tiền"><br>
                    <input class="input-template" required name="<?php echo ProductTable::$COL_PRODUCT_COLOR?>" 
                        type="text" placeholder="Nhập tên màu"><br>
                    <input type="file" required name="<?php echo ProductTable::$COL_PRODUCT_IMAGE_PATH?>" 
                        placeholder="Tải ảnh lên">
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