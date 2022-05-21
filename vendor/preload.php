<?php
require_once "./App/Controller/BaseController.php";
require_once "./App/Controller/Home.php";
require_once "./App/Controller/ShopingCart.php";
require_once "./App/Controller/ShopController.php";
require_once "./App/Controller/BlogController.php";
require_once "./App/Controller/ContactController.php";
require_once "./App/Controller/UserAccountController.php";
require_once "./App/Controller/AdminController.php";
require_once "./App/Controller/UserDashboardController.php";
require_once "./App/Controller/PaymentController.php";
require_once "./App/Controller/DeliveryController.php";
require_once "./App/Controller/AdminAnalyticController.php";
require_once "./Core/Route.php";
require_once "./App/View/View.php";
require_once "./Core/HTML.php";

/*Database*/
require_once "./App/Database/DatabaseConfig.php";
require_once "./App/Database/Database.php";
require_once "./App/Database/Query.php";
require_once "./App/Database/BaseDAO.php";
require_once "./App/Database/ProductDAO.php";
require_once "./App/Database/CategoryDAO.php";
require_once "./App/Database/ProductTypeDAO.php";
require_once "./App/Database/UserDAO.php";
require_once "./App/Database/CartDAO.php";
require_once "./App/Database/CustomerDAO.php";
require_once "./App/Database/OrderDAO.php";
require_once "./App/Database/OrderDetailDAO.php";
require_once "./App/Database/ShippingAddressDAO.php";

/*Model*/
require_once "./App/Model/Cart.php";
require_once "./App/Model/Category.php";
require_once "./App/Model/Customer.php";
require_once "./App/Model/Order.php";
require_once "./App/Model/OrderDetail.php";
require_once "./App/Model/Product.php";
require_once "./App/Model/ProductType.php";
require_once "./App/Model/User.php";
require_once "./App/Model/ShippingAddress.php";
?>