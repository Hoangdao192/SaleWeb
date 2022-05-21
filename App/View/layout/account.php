<?php
use App\View;
use Core\HTML;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a914f93d25.js" crossorigin="anonymous"></script>
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo HTML::style("account.css")?>">
    <link rel="stylesheet" href="<?php echo HTML::style("toast.css")?>">
    <script>
        function toast({title, message}) {
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

            setTimeout(function() {
                toastContainer.removeChild(toastItem);
            }, 4000);
        }

        function getDomainUrl() {
            return document.getElementById("domain-url").value;
        }
    </script>
</head>

<input type="hidden" id="domain-url" value="<?php echo HTML::getRootUrl()?>">
<body>
    <div id="toast">
    </div>
    <div class="container">
        <?php
            if (isset($data["page"])) {
                View::render($data["page"], $data);
            }
        ?>
    </div>
</body>
</html>