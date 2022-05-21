<?php
use App\Database\DAO\CategoryDAO;

$productTypes = $data['producttypes'];
$categoryDAO = $data['categoryDAO'];
?>
<style>
    .product_type_edit {
        cursor: pointer;
    }

    .product_type_edit:hover {
        text-decoration: underline;
    }

    .product_type_delete {
        cursor: pointer;
    }

    .product_type_delete:hover {
        text-decoration: underline;
    }
</style>
<div class="admin-content-right">
    <div class="admin-content-right-cartegory-list">
        <h1>Danh sách loại sản phẩm</h1>
        <table class="content-table">
            <thead class="table-head">
                <tr>
                    <th>STT</th>
                    <th>ID</th>
                    <th>Danh mục</th>
                    <th>Tên loại sản phẩm</th>
                    <th>Tùy chọn</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < sizeof($productTypes); $i++) {
                    $productType = $productTypes[$i];
                    $categoryId = $productType->categoryId;
                    $category = $categoryDAO->getCategory($categoryId);
                ?>
                    <tr class="product-type-item">
                        <td><?php echo $i ?></td>
                        <td class="product-type-id"><?php echo $productType->id ?></td>
                        <td><?php echo $category->name ?></td>
                        <td><?php echo $productType->name ?></td>
                        <td><span class="product_type_edit">Sửa</span>
                            |<span class="product_type_delete">Xóa</span>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    var productTypeItems = document.querySelectorAll(".product-type-item");
    for (let i = 0; i < productTypeItems.length; ++i) {
        productTypeItems[i].querySelector(".product_type_delete").addEventListener('click', function(){
            openPostRequest(`${getDomainUrl()}/admin/deleteproducttype`, {
                productTypeId : productTypeItems[i].querySelector(".product-type-id").innerHTML
            });
        })
        productTypeItems[i].querySelector(".product_type_edit").addEventListener('click', function(){
            openPostRequest(`${getDomainUrl()}/admin/editproducttype`, {
                productTypeId : productTypeItems[i].querySelector(".product-type-id").innerHTML
            });
        })
    }
</script>