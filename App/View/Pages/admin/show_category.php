<?php
$categories = $data['categories'];
?>
<style>
    .category_edit {
        cursor: pointer;
    }

    .category_edit:hover {
        text-decoration: underline;
    }

    .category_delete {
        cursor: pointer;
    }

    .category_delete:hover {
        text-decoration: underline;
    }
</style>
<div class="admin-content-right">
    <div class="admin-content-right-cartegory-list">
        <h1 class="content-title">Danh sách danh mục</h1>
        <table class="content-table">
            <thead class="table-head">
                <tr>
                    <th>STT</th>
                    <th>ID</th>
                    <th>Tên danh mục</th>
                    <th>Tùy chọn</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < sizeof($categories); $i++) {
                    $category = $categories[$i];
                ?>
                    <tr class="category-item">
                        <td><?php echo $i ?></td>
                        <td class="category-id"><?php echo $category->id ?></td>
                        <td><?php echo $category->name ?></td>
                        <td><span class="category_edit">Sửa</span>
                            |<span class="category_delete">Xóa</span>
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
    var categoryItems = document.querySelectorAll(".category-item");
    for (let i = 0; i < categoryItems.length; ++i) {
        categoryItems[i].querySelector(".category_delete").addEventListener('click', function(){
            openPostRequest("http://localhost/saleweb/admin/deletecategory", {
                categoryId : categoryItems[i].querySelector(".category-id").innerHTML
            });
        })
        categoryItems[i].querySelector(".category_edit").addEventListener('click', function(){
            openPostRequest("http://localhost/saleweb/admin/editcategory", {
                categoryId : categoryItems[i].querySelector(".category-id").innerHTML
            });
        })
    }
</script>