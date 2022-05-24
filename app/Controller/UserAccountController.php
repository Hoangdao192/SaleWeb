<?php
namespace App\Controller;

use App\Controller\BaseController;
use App\Database\DAO\UserDAO;
use App\Database\DAO\CustomerDAO;
use App\Database\DAO\ShippingAddressDAO;
use App\Model\Customer;
use App\Model\ShippingAddress;
use App\Model\User;
use Core\HTML;
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

                $url = HTML::getUrl("login");
                Route::openPostRequest($url, $response);
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

                    $url = HTML::getUrl("home");
                    header("Location: $url");
                    exit();
                } else {
                    //  Wrong password
                    $response = [
                        "status" => "fail",
                        "message" => "Sai mật khẩu"
                    ];

                    $url = HTML::getUrl("login");
                    Route::openPostRequest($url, $response);
                }
            }
        }
    }

    public function register() {
        if (isset($_POST["userName"]) && isset($_POST["userPassword"])) {
            $userName = $_POST["userName"];
            $userPassword = $_POST["userPassword"];
            $userAge = $_POST['age'];
            $userFullname = $_POST['fullname'];
            $userGender = $_POST['gender'];
            $userDateOfBirth = $_POST['dateOfbirth'];
            $userAddress = $_POST['address'];
            $userPhoneNumber = $_POST['phone'];
            // $userEmail = $_POST['email'];

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

                $url = HTML::getUrl("registration");
                Route::openPostRequest($url, $response);
            } else {
                $user = new User();
                $user->userName = $userName;
                $user->userPassword = $userPassword;
                $user->userType = "customer";
                $userDAO->insertUser($user);
        
                $user = $userDAO->getUserByUsername($userName);
                $customer = new Customer();
                $customer->userId = $user->userId;
                $customer->customerName = $userFullname;
                $customer->age = intval($userAge);
                // $customer->email = $userEmail;
                $customer->phoneNumber = $userPhoneNumber;
                $customer->address = $userAddress;
                $customer->gender = $userGender;
                $customer->dateOfBirth = $userDateOfBirth;
                $customerDAO->insertCustomer($customer);

                $shippingAddressDAO = new ShippingAddressDAO();
                $shippingAddress = new ShippingAddress();
                $shippingAddress->userId = $user->userId;
                $shippingAddress->address = $userAddress;
                $shippingAddress->receiverName = $userFullname;
                $shippingAddress->receiverPhoneNumber = $userPhoneNumber;
                $shippingAddressDAO->insert($shippingAddress);

                $url = HTML::getUrl("login");
                header("Location: $url");
            }
        }
    }

    public function logout() {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
    }

    public function test() {
        $data = ["page" => "Pages/test"];
        if (isset($_POST['message'])) {
            $data['message'] = $_POST['message'];
        }
        $this->views("layout.account", $data);
    }
}
?>