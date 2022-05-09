<?php
include "header.php";
include "slider.php";

include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/order_table.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/customer_table.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/UserTable.php";
?>

<?php
$order_table = new OrderTable;
$orders = $order_table->get_all();

$customer_table = new CustomerTable();
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
                        $customer = $customer_table->get_customer(intval($order->userId));
                        $user = $userTable->getUserById($order->userId);
                ?>
                        <tr class="table-item">
                            <td><?php echo $i ?></td>
                            <td class="order-number"><?php echo $order->order_number ?></td>
                            <td><?php echo $order->userId?></td>
                            <td><?php echo $user->userName?></td>
                            <td><?php echo $order->order_date?></td>
                            <td><?php echo number_format($order->total_price, 0, ',', '.')?>đ</td>
                            <td>
                                <a href="delete_product.php?<?php echo 1?>=<?php echo 2 ?>">Xóa</a>
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