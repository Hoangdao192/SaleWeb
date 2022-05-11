<?php 
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/UserTable.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/CustomerTable.php";

$regisSucces = true;
$logCode = 0;
/**
 * 0: registration successful.
 * 1: user is exists.
 */

if (isset($_POST["userName"]) && isset($_POST["userPassword"])) {
    $userName = $_POST["userName"];
    $userPassword = $_POST["userPassword"];

    /*Check if username is exists.*/
    $userTable = new UserTable();
    $customerTable = new CustomerTable();
    $user = $userTable->getUserByUsername($userName);
    if ($user != null) {
        $logCode = 1;
    } else {
        $user = new User();
        $user->userName = $userName;
        $user->userPassword = $userPassword;
        $user->userType = "customer";
        $userTable->insertUser($user);

        $user = $userTable->getUserByUsername($userName);
        $customer = new Customer();
        $customer->userId = $user->userId;
        $customer->customerName = $userName;
        $customerTable->insertCustomer($customer);
        header('Location: login');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a914f93d25.js" crossorigin="anonymous"></script>
    <title>Document</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/toast.css">
</head>
<body>
<div id="toast" logincode=<?php echo $logCode?>>

</div>
    <div class="container">
        
        <div class="title">
            ĐĂNG KÝ TÀI KHOẢN
        </div>
        <div class="form">
            <form action="" method="POST">
                <div class="form--item form__username">
                    <i class="fa-solid fa-user form--item__icon form__username__icon"></i>
                    <input name="userName" class="form--item__input form__username__input" type="text" placeholder="Tên tài khoản">
                </div>
                <div class="form--item form__password">
                    <i class="fa-solid fa-lock form--item__icon form__password__icon"></i>
                    <input name="userPassword" class="form--item__input form__password__input" type="password" placeholder="Mật khẩu">
                </div>
                <button type="submit" class="form__submitbtn">Đăng ký</button>
                <div class="form__more">
                    Bạn đã có tài khoản ? <a class="form__more__signup" href="login">Đăng nhập</a>
                </div>
            </form>
        </div>
    </div>
</body>
<script>
    if (document.readyState != 'loading'){
        loginPageReady();
    } else {
        document.addEventListener('DOMContentLoaded', loginPageReady());
    }

    function loginPageReady() {
        var toastContainer = document.getElementById("toast");
        if (parseInt(toastContainer.getAttribute("logincode")) == 1) {
            window.alert("Người dùng đã tồn tại");
        }
    }

    function toast({
        title, message
    }) {
        var toastContainer = document.getElementById("toast");
        var toastItem = document.createElement('div');
        toastItem.classList.add("toast-item");

        toastItem.innerHTML = `
            <div class="toast__check-icon">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div class="toast__message">
            <p class="toast__message__title">${title}</p>
            </div>
            <i class="fa-solid fa-xmark toast__close-icon"></i>
        `;
        toastContainer.appendChild(toastItem);

        setTimeout(function (){
            toastContainer.removeChild(toastItem);
        }, 4000);
    }
</script>
</html>