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
    </script>
</head>
<body>
    <section class="header">
        <h1>Khách hàng</h1>
    </section>
    <section class="admin-content">
        <div class="admin-content-left">
            <div id="order-button" class="content-left-item order-button" style="cursor:pointer">
                <img src="<?php echo HTML::image("shopping-cart.png")?>" alt="">
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
<script src="<?php echo HTML::script("user_dashboard.js")?>"></script>
</html>