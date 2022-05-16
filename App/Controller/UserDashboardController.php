<?php
namespace App\Controller;

use App\Controller\BaseController;
use App\Database\DAO\UserDAO;
use App\Database\DAO\OrderDAO;
use App\Database\DAO\OrderDetailDAO;
use App\Database\DAO\ProductDAO;

class UserDashboardController extends BaseController {
    public function showOrder() {
        $user = json_decode($_SESSION['user']);
        $userDAO = new UserDAO();
        $user = $userDAO->getUserByUsername($user->userName);
        $orderDAO = new OrderDAO();
        $orders = $orderDAO->getAllFilterByUserId($user->userId);
        $data = [
            'page' => "Pages/show_order",
            'orders' => $orders,
            'user' => $user
        ];
        $this->views('layout.user_dashboard', $data);
    }

    public function showOrderDetail() {
        $orderNumber = $_POST['orderNumber'];
        $orderDAO = new OrderDAO();
        $order = $orderDAO->getOrder($orderNumber);
        $orderDetailDAO = new OrderDetailDAO;

        $data = [
            'page' => "Pages/show_order_detail",
            'order' => $order,
            'orderDetails' => $orderDetailDAO->getAllFilterByOrderNumber($orderNumber),
            'productDAO' => new ProductDAO
        ];
        $this->views('layout.user_dashboard', $data);
    }

    public function deleteOrder() {
        $orderNumber = $_POST['orderNumber'];
        $orderDAO = new OrderDAO();
        $orderDAO->deleteOrder($orderNumber);
        header('Location: http://localhost/saleweb/user/dashboard');
    }
}
?>