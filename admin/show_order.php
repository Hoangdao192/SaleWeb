<?php
include "header.php";
include "slider.php";

include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/OrderTable.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/CustomerTable.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/UserTable.php";
?>

<?php
$orderTable = new OrderTable;
$orders = $orderTable->getAll();

$customerTable = new CustomerTable();
?>

<div class="admin-content-right">
    <div class="admin-content-right-cartegory-list">
        <h1>Danh sách đơn hàng</h1>
        <table class="content-table">
            <thead class="table-head">
                <tr>
                    <th>STT</th>
                    <th>ID</th>
                    <th>Mã khách hàng</th>
                    <th>Tên khách hàng</th>
                    <th>Ngày đặt</th>
                    <th>Tổng tiền</th>
                    <th>Tùy chọn</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($orders) {
                    $userTable = new UserTable();
                    for ($i = 0; $i < sizeof($orders); ++$i) {
                        $order = $orders[$i];
                        $customer = $customerTable->getCustomer(intval($order->userId));
                        $user = $userTable->getUserById($order->userId);
                ?>
                        <tr class="table-item">
                            <td><?php echo $i ?></td>
                            <td class="order-number"><?php echo $order->orderNumber ?></td>
                            <td><?php echo $order->userId?></td>
                            <td><?php echo $user->userName?></td>
                            <td><?php echo $order->orderDate?></td>
                            <td><?php echo number_format($order->totalPrice, 0, ',', '.')?>đ</td>
                            <td>
                                <a href="delete_order.php?<?php echo OrderTable::$COL_ORDER_NUMBER?>=<?php echo $order->orderNumber?>">Xóa</a>
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