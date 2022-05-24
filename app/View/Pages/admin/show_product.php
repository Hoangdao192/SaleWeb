<?php
use App\Database\DAO\ProductTypeDAO;
use App\Database\DAO\ProductDAO;
use App\Database\DAO\CategoryDAO;

$products = $data['products'];
$productTypeDAO = $data['productTypeDAO'];
$categoryDAO = $data['categoryDAO'];
?>

<style>
    .product_edit {
        cursor: pointer;
    }

    .product_edit:hover {
        text-decoration: underline;
    }

    .product_delete {
        cursor: pointer;
    }

    .product_delete:hover {
        text-decoration: underline;
    }
</style>
<div class="admin-content-right">
    <div class="admin-content-right-cartegory-list">
        <h1>Danh sách sản phẩm</h1>
        <table class="content-table">
            <thead class="table-head">
                <tr>
                    <th>STT</th>
                    <th>ID</th>
                    <th>Danh mục</th>
                    <th>Loại sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Màu</th>
                    <th>Giá tiền</th>
                    <th>Hình ảnh</th>
                    <th>Tùy biến</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($products) {
                    $i = 0;
                    for ($i = 0; $i < sizeof($products); ++$i) {
                        $product = $products[$i];
                        $productTypeId = $product->typeId;
                        $productType = $productTypeDAO->getProductType($productTypeId);
                        $categoryId = $productType->categoryId;
                        $category = $categoryDAO->getCategory($categoryId);
                ?>
                        <tr class="product-item">
                            <td><?php echo $i ?></td>
                            <td class="product-id"><?php echo $product->id ?></td>
                            <td><?php echo $category->name?></td>
                            <td><?php echo $productType->name?></td>
                            <td><?php echo $product->name ?></td>
                            <td>
                                <?php
                                    $colorString = "";
                                    for ($j = 0; $j < sizeof($product->color); ++$j) {
                                        if (strlen($colorString) >= 30) break;
                                        if ($j > 0) $colorString .= "; ";
                                        $colorString .= $product->color[$j];
                                    }
                                    echo $colorString;
                                ?>
                            </td>
                            <td><?php echo number_format($product->price, 0, ',', '.')?>đ</td>
                            <td><?php echo $product->imagePath ?></td>
                            <td><span class="product_edit">Sửa</span>
                                |<span class="product_delete">Xóa</span>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    var productTypeItems = document.querySelectorAll(".product-item");
    for (let i = 0; i < productTypeItems.length; ++i) {
        productTypeItems[i].querySelector(".product_delete").addEventListener('click', function(){
            openPostRequest(`${getDomainUrl()}/admin/deleteproduct`, {
                productId : productTypeItems[i].querySelector(".product-id").innerHTML
            });
        })
        productTypeItems[i].querySelector(".product_edit").addEventListener('click', function(){
            openPostRequest(`${getDomainUrl()}/admin/editproduct`, {
                productId : productTypeItems[i].querySelector(".product-id").innerHTML
            });
        })
    }
</script>
