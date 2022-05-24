<?php
namespace App\Controller;

use App\Controller\BaseController;
use App\Database\DAO\CustomerDAO;
use App\Database\DAO\UserDAO;
use App\Database\DAO\OrderDAO;
use App\Database\DAO\OrderDetailDAO;
use App\Database\DAO\ProductDAO;
use App\Model\Customer;
use Core\HTML;

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

    public function showProfilePage() {
        $user = json_decode($_SESSION['user']);
        $customerDAO = new CustomerDAO();
        $customer = $customerDAO->getCustomer($user->userId);
        $orderDAO = new OrderDAO();
        $orders = $orderDAO->getAllFilterByUserId($user->userId);
        $data = [
            'page' => "Pages/profile",
            'customer' => $customer,
            'orders' => $orders
        ];
        $this->views('layout.user_dashboard', $data);
    }

    public function deleteOrder() {
        $orderNumber = $_POST['orderNumber'];
        $orderDAO = new OrderDAO();
        $orderDAO->deleteOrder($orderNumber);

        $url = HTML::getUrl("user/dashboard");
        header("Location: $url");
    }

    public function updateCustomerInformation() {
        $customerName = $_POST['customerName'];
        $age = intval($_POST['age']);
        $phoneNumber = $_POST['phoneNumber'];
        $gender = $_POST['gender'];
        $dateOfBirth = $_POST['dateOfBirth'];
        $address = $_POST['address'];
        $user = json_decode($_SESSION['user']);

        $customer = new Customer();
        $customer->userId = $user->userId;
        $customer->customerName = $customerName;
        $customer->age = $age;
        $customer->gender = $gender;
        $customer->phoneNumber = $phoneNumber;
        $customer->address = $address;
        $customer->dateOfBirth = $dateOfBirth;
        $customerDAO = new CustomerDAO();
        $customerDAO->updateCustomer($customer);
    }

    public function showShippingAddress() {
        $data = [
            'page' => 'Pages/shipping_address',
            'user' => $this->getUser()
        ];
        $this->views('layout.user_dashboard', $data);
    }
}
?>