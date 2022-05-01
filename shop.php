<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/product_table.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/product_type_table.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/category_table.php";

$product_table = new ProductTable;
$products = $product_table->get_all();

$product_type_table = new ProductTypeTable;

$category_table = new CategoryTable;
$categories = $category_table->get_all();

$category_id = 0;
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
} else {
    $category_id = $categories[0]->id;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a914f93d25.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/font.css">
    <link rel="stylesheet" href="css/product.css">
    <link rel="stylesheet" href="css/shop.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <title>SHOP</title>
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajax({
                type: 'post',
                url: 'admin/ShoppingCartAction.php',
                data: {
                    action: 'count'
                },
                success: function(data) {
                    document.getElementById("cart-product-number").innerHTML = data;
                }
            });
            showProductByCategory();
        });

        function showProductByCategory() {
            $.ajax({
                type: 'get',
                url: 'app/database/product_view.php',
                data: {
                    id: <?php echo $category_id?>
                },
                success: function(response) {
                    var contentRight = document.querySelectorAll(".content-right-content")[0];
                    contentRight.innerHTML = response;
                }
            });
        }

        function showProductByType() {
            var productTypeSelector = document.getElementById("product-type");
            var productTypeId = productTypeSelector.options[productTypeSelector.selectedIndex].value;
            if (productTypeId == -1) {
                showProductByCategory();
                return;
            }
            $.ajax({
                type: 'get',
                url: 'app/database/product_view.php',
                data: {
                    productTypeId: productTypeId,
                    page: 1
                },
                success: function(response) {
                    var contentRight = document.querySelectorAll(".content-right-content")[0];
                    contentRight.innerHTML = response;
                }
            });
        }

        function addToCart(productId, productSize, colorRadioGroupId, colorArray) {
            console.log(productId);

            //  Get selected color
            var radioGroup = document.getElementById(colorRadioGroupId);
            console.log(radioGroup);
            var radioArray = radioGroup.querySelectorAll(".radio");
            console.log(radioArray);
            var productColor;
            for (let i = 0; i < radioArray.length; i++) {
                if (radioArray[i].checked) {
                    productColor = radioArray[i].value;
                }
            }

            console.log(productId + " " + productSize + " " + productColor);
            $.ajax({
                type: 'post',
                url: 'admin/ShoppingCartAction.php',
                data: {
                    action: 'add',
                    productId: productId,
                    productSize: productSize,
                    productColor: productColor,
                    productQuantity: 1
                },
                success: function(response) {
                    document.getElementById("cart-product-number").innerHTML = response;
                }
            });
        }

        function showProductDetail(productId) {
            console.log("clicked");
                    window.location.href = "./product.php?productId=" + productId;
        }

        function searchProduct() {
            var productTypeSelector = document.getElementById("product-type");
            var searchBox = document.getElementById("search-box");

            var productTypeId = productTypeSelector.options[productTypeSelector.selectedIndex].value;
            var target = searchBox.value;
            $.ajax({
                type: 'get',
                url: 'app/database/product_search.php',
                data: {
                    productTypeId: productTypeId,
                    categoryId: <?php echo $category_id?>,
                    targetName: target,
                    page: 1
                },
                success: function(response) {
                    console.log("search called");
                    var contentRight = document.querySelectorAll(".content-right-content")[0];
                    contentRight.innerHTML = response;
                }
            });
        }
    </script>
</head>

<body>
    <?php
    include "common/header.php";
    ?>

    <section class="directory">
        <h1>Cửa hàng</h1>
        <p>Trang chủ &nbsp;<span></span>&nbsp; Cửa hàng</p>
    </section>
    <!----------------------Content------------------------->
    <section class="content">
        <div class="content-left">
            <div class="search-box">
                <input id="search-box" type="text" placeholder="Tìm kiếm">
                <i onclick="searchProduct()" id="search-button" class="fa-solid fa-magnifying-glass"></i>
            </div>
            <div class="categories">
                <h1>DANH MỤC</h1><i class="show-categories fa-solid fa-chevron-down"></i>
                <div class="categories-sub-menu">
                    <?php
                    for ($i = 0; $i < sizeof($categories); ++$i) {
                        $category = $categories[$i];
                    ?>
                        <input style="display: none;" type="number" name="category_id" value="<?php echo $category->id ?>">
                        <br>
                        <a style="<?php if ($category_id == $category->id) echo "color:black" ?>" href="shop.php?category_id=<?php echo $category->id?>">
                            <?php echo $category->name ?>
                        </a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="content-right">
            <div class="content-right-head">
                <select name="product-type" id="product-type" onchange="showProductByType()">
                    <option value="-1">Hiển thị tất cả</option>
                    <?php
                    //  Get all product type from database and show it to selector
                    $product_types = $product_type_table->get_all_filter_by_category($category_id);
                    for ($i = 0; $i < sizeof($product_types); ++$i) {
                        $product_type = $product_types[$i];
                    ?>
                        <option value="<?php echo $product_type->id ?>"><?php echo $product_type->name ?></option>
                    <?php
                    }
                    ?>
                </select>
                <div class="content-right-head-sort">
                    <p>Sắp xếp: </p>
                    <select name="sort-type" id="sort-type">
                        <option value="low-to-high">Giá thấp đến cao</option>
                        <option value="high-to-low">Giá cao đến thấp</option>
                        <option value="a-to-z">A đến Z</option>
                        <option value="z-to-a">Z đến A</option>
                    </select>
                </div>
            </div>
            <div class="content-right-content">
                <!--------------------Content will be add by ajax------------------->
            </div>
            <div class="content-right-bottom">
                <p><span>1</span><span>2</span><span>3</span></p>
            </div>
        </div>
    </section>
    <!---------------------FOOTER------------------------->
    <?php
    include "common/footer.php"
    ?>
</body>
<script src="javascript/shop.js"></script>
</html>