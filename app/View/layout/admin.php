<?php
use Core\HTML;
use App\View;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo HTML::style("admin.css")?>">
    <link rel="stylesheet" href="<?php echo HTML::style("table.css")?>">
    <link rel="stylesheet" href="<?php echo HTML::style("input.css")?>">
    <link rel="stylesheet" href="<?php echo HTML::style("button_template.css")?>">
    <script src="https://kit.fontawesome.com/a914f93d25.js" crossorigin="anonymous"></script>
    <title>Admin</title>
    
    <script>
        function openPostRequest(url, data) {
            var form = document.createElement('form');
            form.action = url;
            form.method = "POST";
            form.style.display = "none";
            Object.entries(data).forEach(entry => {
                const [key, value] = entry;
                var input = document.createElement('input');
                input.type = "hidden";
                input.name = key;
                input.value = value;
                form.appendChild(input);
            });
            document.body.appendChild(form);
            form.submit();
        }
        function getDomainUrl() {
            return document.getElementById("domain-url").value;
        }
    </script>
</head>
<body>
    <input type="hidden" id="domain-url" value="<?php echo HTML::getRootUrl()?>">
    <section class="header">
        <h1>Quản trị viên</h1>
    </section>
    <section class="admin-content">
        <div class="admin-content-left">
            <div class="content-left-item category">
                <!-- <img src="<?php echo HTML::image("categories.png")?>" alt=""> -->
                <i class="fa-solid fa-table-cells-large"></i>
                <span>Danh mục</span>
                <i class="fa-xs fa-solid fa-chevron-right more"></i>
                <div class="content-left-sub-menu category-sub-menu">
                    <li><a href="<?php echo HTML::getUrl("admin/addcategory")?>">Thêm mới</a></li>
                    <li><a href="<?php echo HTML::getUrl("admin/category")?>">Xem tất cả</a></li>
                </div>
            </div>
            <div class="content-left-item product_type">
                <i class="fa-solid fa-bars"></i>
                <!-- <img src="<?php echo HTML::image("menu.png")?>" alt=""> -->
                <span>Loại sản phẩm</span>
                <i class="fa-xs fa-solid fa-chevron-right more"></i>
                <div class="content-left-sub-menu">
                    <li><a href="<?php echo HTML::getUrl("admin/addproducttype")?>">Thêm mới</a></li>
                    <li><a href="<?php echo HTML::getUrl("admin/producttype")?>">Xem tất cả</a></li>
                </div>
            </div>
            <div class="content-left-item product">
                <!-- <img src="<?php echo HTML::image("shopping-bag.png")?>" alt=""> -->
                <i class="fa-solid fa-shirt"></i>
                <span>Sản phẩm</span>
                <i class="fa-xs fa-solid fa-chevron-right more"></i>
                <div class="content-left-sub-menu">
                    <li><a href="<?php echo HTML::getUrl("admin/addproduct")?>">Thêm mới</a></li>
                    <li><a href="<?php echo HTML::getUrl("admin/product")?>">Xem tất cả</a></li>
                </div>
            </div>
            <div id="statitics-button" class="content-left-item statitics-button" style="cursor:pointer">
                <i class="fa-solid fa-chart-line"></i>
                <span>Thống kê</span>
            </div>
            <div id="customer-button" class="content-left-item customer-button" style="cursor:pointer">
                <i class="fa-solid fa-user"></i>
                <span>Khách hàng</span>
            </div>
            <div id="order-button" class="content-left-item order-button" style="cursor:pointer">
                <!-- <img src="<?php echo HTML::image("shopping-cart.png")?>" alt=""> -->
                <i class="fa-solid fa-cart-shopping"></i>
                <span>Đơn hàng</span>
            </div>
        </div>
        
        <?php
        if (isset($data["page"])) {
            View::render($data["page"], $data);
        }
        ?>

    </section>
</body>
<script src="<?php echo HTML::script("slider.js")?>"></script>
</html>