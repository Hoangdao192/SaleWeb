<?php
namespace App\Controller;

use App\Controller\BaseController;
use App\Database\DAO\UserDAO;
use App\Database\DAO\CustomerDAO;
use App\Model\Customer;
use App\Model\User;
use Core\Route;

class UserAccountController extends BaseController {
    public function showLoginPage() {
        $data = ["page" => "Pages/login"];
        if (isset($_POST['message'])) {
            $data['message'] = $_POST['message'];
        }
        $this->views("layout.account", $data);
    }

    public function showRegisterPage() {
        $data = ["page" => "Pages/registration"];
        if (isset($_POST['message'])) {
            $data['message'] = $_POST['message'];
        }
        $this->views("layout.account", $data);
    }

    public function login() {
        if (isset($_POST["userName"]) && isset($_POST["userPassword"])) {
            $userName = $_POST["userName"];
            $userPassword = $_POST["userPassword"];

            /*Check if username is exists.*/
            $userDAO = new UserDAO();
            $user = $userDAO->getUserByUsername($userName);
            if ($user == null) {
                //  User is not exists
                $response = [
                    "status" => "fail",
                    "message" => "Tài khoản không tồn tại"
                ];
                Route::openPostRequest("http://localhost/saleweb/login", $response);
            } else {
                if ($userPassword == $user->userPassword) {
                    /*Login successful.*/
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    $userJSON = [
                        "userId" => $user->userId, 
                        "userName" => $user->userName, 
                        "userPassword" => $user->userPassword, 
                        "userType" => $user->userType
                    ];
                    $_SESSION['user'] = json_encode($userJSON);
                    // $cart = new ShopingCart();
                    // $cart->loadFromDatabase();
                    header('Location: http://localhost/saleweb/home');
                    exit();
                } else {
                    //  Wrong password
                    $response = [
                        "status" => "fail",
                        "message" => "Sai mật khẩu"
                    ];
                    Route::openPostRequest("http://localhost/saleweb/login", $response);
                }
            }
        }
    }

    public function register() {
        if (isset($_POST["userName"]) && isset($_POST["userPassword"])) {
            $userName = $_POST["userName"];
            $userPassword = $_POST["userPassword"];
        
            /*Check if username is exists.*/
            $userDAO = new UserDAO();
            $customerDAO = new CustomerDAO();
            $user = $userDAO->getUserByUsername($userName);
            if ($user != null) {
                //  User is exists
                $response = [
                    "status" => "fail",
                    "message" => "Tài khoản đã tồn tại"
                ];
                Route::openPostRequest("http://localhost/saleweb/registration", $response);
            } else {
                $user = new User();
                $user->userName = $userName;
                $user->userPassword = $userPassword;
                $user->userType = "customer";
                $userDAO->insertUser($user);
        
                $user = $userDAO->getUserByUsername($userName);
                $customer = new Customer();
                $customer->userId = $user->userId;
                $customer->customerName = $userName;
                $customerDAO->insertCustomer($customer);
                header('Location: http://localhost/saleweb/login');
            }
        }
    }

    public function logout() {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
    }
}
?>