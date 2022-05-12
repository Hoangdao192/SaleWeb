<?php
include "header.php";
include "slider.php";

include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/OrderTable.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/CustomerTable.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/UserTable.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<?php
$user = json_decode($_SESSION['user']);

$userTable = new UserTable();
$user = $userTable->getUserByUsername($user->userName);

$order_table = new OrderTable;
$orders = $order_table->getAllFilterByUserId($user->userId);
?>

<div class="admin-content-right">
    <div class="admin-content-right-cartegory-list">
        <h1>Danh sách đơn hàng</h1>
        <table class="content-table">
            <thead class="table-head">
                <tr>
                    <th>STT</th>
                    <th>Ngày đặt</th>
                    <th>Tổng tiền</th>
                    <th>Tùy chọn</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($orders) {
                    for ($i = 0; $i < sizeof($orders); ++$i) {
                        $order = $orders[$i];
                ?>
                        <tr class="table-item">
                            <td><?php echo $i ?></td>                            
                            <td style="display: none;" class="order-number"><?php echo $order->orderNumber ?></td>
                            <td><?php echo $order->orderDate?></td>
                            <td><?php echo number_format($order->totalPrice, 0, ',', '.')?>đ</td>
                            <td>
                                <a href="delete_product.php?<?php echo 1?>=<?php echo 2 ?>">Hủy đơn</a>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</section>
</body>
<script>
    const orderDetailItems = document.querySelectorAll(".table-item");
    for (let i = 0; i < orderDetailItems.length; ++i) {
        orderDetailItems[i].addEventListener('click', function(){
            var orderNumber = parseInt(orderDetailItems[i].querySelector(".order-number").innerHTML);
            window.location.href = "show_order_detail.php?orderNumber=" + orderNumber;
        })
    }
</script>
</html>