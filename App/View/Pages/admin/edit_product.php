<?php
use App\Database\DAO\ProductDAO;
use Core\HTML;

$product = $data['product'];
$productTypes = $data['productTypes']
?>
<div class="admin-content-right">
            <div class="admin-content-right-cartegory-add">
                <h1 class="content-title">Sửa sản phẩm</h1>
                <form action="<?php echo HTML::getUrl("admin/updateproduct")?>" method="POST" class="submit_form" enctype="multipart/form-data">
                    <input type="hidden" name="<?php echo ProductDAO::$COL_PRODUCT_ID?>" value="<?php echo $product->id?>">
                    <select required name="<?php echo ProductDAO::$COL_PRODUCT_TYPE_ID?>" id="loaisp">
                        <option value="#">Chọn danh mục</option>
                        <?php
                            for ($i = 0; $i < sizeof($productTypes); ++$i) {
                                $productType = $productTypes[$i];
                        ?>
                                <option value="<?php echo $productType->id?>"><?php echo $productType->name?></option>
                        <?php
                            }
                        ?>
                    </select><br>
                    <input class="input-template" required name="<?php echo ProductDAO::$COL_PRODUCT_NAME?>" type="text" 
                        placeholder="Nhập tên sản phẩm" value="<?php echo $product->name?>"><br>
                    <input class="input-template" required name="<?php echo ProductDAO::$COL_PRODUCT_PRICE?>" type="number" 
                        placeholder="Nhập giá tiền" value="<?php echo $product->price?>"><br>
                    <input class="input-template" required name="<?php echo ProductDAO::$COL_PRODUCT_COLOR?>" type="text" 
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
                    <input type="file" required name="<?php echo ProductDAO::$COL_PRODUCT_IMAGE_PATH?>" placeholder="Tải ảnh lên">
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
</script>
</html>