<?php 
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/UserTable.php";

$loginSuccess = true;
$loginCode = 0;
/**
 * 0: login successful.
 * 1: user is not exists.
 * 2: wrong password.
 */

if (isset($_POST["userName"]) && isset($_POST["userPassword"])) {
    $userName = $_POST["userName"];
    $userPassword = $_POST["userPassword"];

    /*Check if username is exists.*/
    $userTable = new UserTable();
    $user = $userTable->getUserByUsername($userName);
    if ($user == null) {
        $loginCode = 1;
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
            header('Location: index.php');
            exit();
        } else {
            $loginCode = 2;
        }
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
<div id="toast" logincode=<?php echo $loginCode?>>

</div>
    <div class="container">
        
        <div class="title">
            ĐĂNG NHẬP TÀI KHOẢN
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
                <button type="submit" class="form__submitbtn">Đăng nhập</button>
                <div class="form__more">
                    Bạn chưa có tài khoản ? <a class="form__more__signup" href="registration">Đăng ký</a>
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
            window.alert("Người dùng không tồn tại");
        } else if (parseInt(toastContainer.getAttribute("logincode")) == 2) {
            window.alert("Sai mật khẩu");
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