<?php
use App\Database\DAO\ProductDAO;

$productTypes = $data['productTypes'];
?>

<div class="admin-content-right">
            <div class="admin-content-right-cartegory-add">
                <h1 class="content-title">Thêm sản phẩm</h1>
                <form action="http://localhost/saleweb/admin/productinput" method="POST" enctype="multipart/form-data" class="submit_form">
                    <select required name="<?php echo ProductDAO::$COL_PRODUCT_TYPE_ID?>" id="loaisp">
                        <option value="#">Chọn loại sản phẩm</option>
                        <?php
                        for ($i = 0; $i < sizeof($productTypes); $i++) {
                            $productType = $productTypes[$i];
                        ?>
                            <option value="<?php echo $productType->id?>"><?php echo $productType->name?></option>
                        <?php
                        }
                        ?>
                    </select><br>
                    <input class="input-template" required name="<?php echo ProductDAO::$COL_PRODUCT_NAME?>" 
                        type="text" placeholder="Nhập tên sản phẩm"><br>
                    <input class="input-template" required name="<?php echo ProductDAO::$COL_PRODUCT_PRICE?>" 
                        type="number" placeholder="Nhập giá tiền"><br>
                    <input class="input-template" required name="<?php echo ProductDAO::$COL_PRODUCT_COLOR?>" 
                        type="text" placeholder="Nhập tên màu"><br>
                    <input type="file" required name="<?php echo ProductDAO::$COL_PRODUCT_IMAGE_PATH?>" 
                        placeholder="Tải ảnh lên">
                    <button class="button-template submitbtn" type="submit">Thêm</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>