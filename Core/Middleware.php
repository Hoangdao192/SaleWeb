<?php
require_once "./vendor/preload.php";

use App\Controller\ShopingCart;
use Core\Route;
use Core\HTML;
use App\View;

$route = new Route();
$route->add("/home", ["controller" => "Home", "action" => "show"]);
$route->add("/shop", ["controller" => "ShopController", "action" => "showMainPage"]);
$route->add("/blog", ["controller" => "BlogController", "action" => "showMainPage"]);
$route->add("/contact", ["controller" => "ContactController", "action" => "showMainPage"]);
$route->add("/cart", ["controller" => "ShopingCart", "action" => "showMainPage"]);
$route->add("/delivery", ['controller' => "ShopingCart", "action" => "showDeliveryPage"]);
$route->add("/login", ["controller" => "UserAccountController", "action" => "showLoginPage"]);
$route->add("/registration", ["controller" => "UserAccountController", "action" => "showRegisterPage"]);

$route->add("/logininput", ["controller" => "UserAccountController", "action" => "login"]);
$route->add("/registerinput", ["controller" => "UserAccountController", "action" => "register"]);

/*User*/
$route->add("/user/dashboard", ['controller' => 'UserDashboardController', 'action' => 'showOrder']);
$route->add("/user/orderdetail", ['controller' => 'UserDashboardController', 'action' => 'showOrderDetail']);
$route->add("/user/deleteorder", ['controller' => 'UserDashboardController', 'action' => 'deleteOrder']);

/*Admin*/
$route->add("/admin/home", ["controller" => "AdminController", "action" => "showHomePage"]);
//  Category
$route->add("/admin/category", ["controller" => "AdminController", "action" => "showCategoryPage"]);
$route->add("/admin/addcategory", ["controller" => "AdminController", "action" => "showAddCategoryPage"]);
$route->add("/admin/editcategory", ["controller" => "AdminController", "action" => "showEditCategoryPage"]);
$route->add("/admin/updatecategory", ["controller" => "AdminController", "action" => "editCategory"]);
$route->add("/admin/categoryinput", ["controller" => "AdminController", "action" => "addCategory"]);
$route->add("/admin/deletecategory", ["controller" => "AdminController", "action" => "deleteCategory"]);
//  ProductType
$route->add("/admin/addproducttype", ["controller" => "AdminController", "action" => "showAddProductTypePage"]);
$route->add("/admin/producttype", ["controller" => "AdminController", "action" => "showProductTypePage"]);
$route->add("/admin/editproducttype", ["controller" => "AdminController", "action" => "showEditProductTypePage"]);
$route->add("/admin/updateproducttype", ["controller" => "AdminController", "action" => "editProductType"]);
$route->add("/admin/producttypeinput", ["controller" => "AdminController", "action" => "addProductType"]);
$route->add("/admin/deleteproducttype", ["controller" => "AdminController", "action" => "deleteProductType"]);
//  Product
$route->add("/admin/addproduct", ["controller" => "AdminController", "action" => "showAddProductPage"]);
$route->add("/admin/product", ["controller" => "AdminController", "action" => "showProductPage"]);
$route->add("/admin/editproduct", ["controller" => "AdminController", "action" => "showEditProductPage"]);
$route->add("/admin/productinput", ["controller" => "AdminController", "action" => "addProduct"]);
$route->add("/admin/updateproduct", ["controller" => "AdminController", "action" => "editProduct"]);
$route->add("/admin/deleteproduct", ["controller" => "AdminController", "action" => "deleteProduct"]);
//  Order
$route->add("/admin/order", ['controller' => 'AdminController', 'action' => 'showOrderPage']);
$route->add("/admin/orderdetail", ['controller' => 'AdminController', 'action' => 'showOrderDetail']);
$route->add("/admin/deleteorder", ['controller' => 'AdminController', 'action' => 'deleteOrder']);

/*Ajax*/
$route->add("/ajax/shopingcart/count", ["controller" => "ShopingCart", "action" => "countItemInCart"]);
$route->add("/ajax/shopingcart/add", ["controller" => "ShopingCart", "action" => "addToCart"]);
$route->add("/ajax/shopingcart/load", ["controller" => "ShopingCart", "action" => "loadCart"]);
$route->add("/ajax/shopingcart/delete", ["controller" => "ShopingCart", "action" => "deleteItem"]);
$route->add("/ajax/shopingcart/createorder", ['controller' => "ShopingCart", "action" => "createOrder"]);
$route->add("/ajax/shop/show_product_by_category", ["controller" => "ShopController", "action" => "showProductByCategory"]);
$route->add("/ajax/shop/show_product_by_type", ["controller" => "ShopController", "action" => "showProductByType"]);
$route->add("/ajax/logout", ["controller" => "UserAccountController", "action" => "logout"]);

// $route->add("", ["controller" => "Home", "action" => "show"]);

if ($route->match($route->convert("/ajax/shopingcart/add"))) {
    if (isset($_SESSION['user'])) {
        $route->dispatch();
    } else {
        $response = [
            "status" => "fail",
            "message" => "Cần đăng nhập để thêm sản phẩm"
        ];
        echo json_encode($response);
    }
} 
else if ($route->match($route->convert("/cart")) && !isset($_SESSION['user'])) {
    $response = [
        "status" => "fail",
        "message" => "Cần đăng nhập để xem giỏ hàng"
    ];
    Route::openPostRequest("http://localhost/saleweb/login", $response);
} else {
    $route->dispatch();
}
?>