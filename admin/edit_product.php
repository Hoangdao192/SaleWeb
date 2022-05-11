<?php
    include "header.php";
    include "slider.php";
    
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/ProductTypeTable.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/ProductTable.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/models/Product.php";
?>
<?php 
    $productTable = new ProductTable;
    if (!isset($_GET[ProductTable::$COL_PRODUCT_ID]) || $_GET[ProductTable::$COL_PRODUCT_ID] == NULL) {
        echo "<script>window.location = 'cartegorylist.php'</script>";
    } else {
        $productId = $_GET[ProductTable::$COL_PRODUCT_ID];
    }
    $product = $productTable->getProduct($productId);
?>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $productTypeTable = new ProductTypeTable;
        $product = new Product();
        $product->id = $productId;
        $product->typeId = $_POST[ProductTable::$COL_PRODUCT_TYPE_ID];
        $product->categoryId = $productTypeTable->getProductType($product->typeId)->categoryId;
        $product->name = $_POST[ProductTable::$COL_PRODUCT_NAME];
        $product->color = $_POST[ProductTable::$COL_PRODUCT_COLOR];
        $product->price = $_POST[ProductTable::$COL_PRODUCT_PRICE];

        $productTable->updateProduct($product, $_FILES);
        header('Location:show_product.php');
    }
?>

<div class="admin-content-right">
            <div class="admin-content-right-cartegory-add">
                <h1 class="content-title">Sửa sản phẩm</h1>
                <form action="" method="POST" class="submit_form" enctype="multipart/form-data">
                    <select required name="<?php echo ProductTable::$COL_PRODUCT_TYPE_ID?>" id="loaisp">
                        <option value="#">Chọn danh mục</option>
                        <?php
                            $productTypeTable = new ProductTypeTable;
                            $productTypes = $productTypeTable->getAll();
                            for ($i = 0; $i < sizeof($productTypes); ++$i) {
                                $productType = $productTypes[$i];
                        ?>
                                <option value="<?php echo $productType->id?>"><?php echo $productType->name?></option>
                        <?php
                            }
                        ?>
                    </select><br>
                    <input class="input-template" required name="<?php echo ProductTable::$COL_PRODUCT_NAME?>" type="text" 
                        placeholder="Nhập tên sản phẩm" value="<?php echo $product->name?>"><br>
                    <input class="input-template" required name="<?php echo ProductTable::$COL_PRODUCT_PRICE?>" type="number" 
                        placeholder="Nhập giá tiền" value="<?php echo $product->price?>"><br>
                    <input class="input-template" required name="<?php echo ProductTable::$COL_PRODUCT_COLOR?>" type="text" 
                        placeholder="Nhập tên màu" value="<?php
                                $colorString = "";
                                for ($j = 0; $j < sizeof($product->color); ++$j) {
                                    if (strlen($colorString) >= 30) break;
                                    if ($j > 0) $colorString .= "; ";
                                    $colorString .= $product->color[$j];
                                }
                                echo $colorString;
                            ?>">
                    <br>
                    <input type="file" required name="<?php echo ProductTable::$COL_PRODUCT_IMAGE_PATH?>" placeholder="Tải ảnh lên">
                    <button class="button-template submitbtn" type="submit">Sửa</button>
                </form>
            </div>
        </div>
    </section>
</body>
<script>
    var selector = document.getElementById('loaisp');
    for(var i, j = 0; i = selector.options[j]; j++) {
        if(i.value == <?php echo $product->typeId?>) {
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