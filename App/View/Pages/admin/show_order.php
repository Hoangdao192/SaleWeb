<?php
use App\Database\DAO\UserDAO;
use App\Database\DAO\OrderDAO;

$orders = $data['orders'];
$userDAO = $data['userDAO'];
$customerDAO = $data['customerDAO'];
?>

<style>
    .delete-item {
        cursor: pointer;
    }
    .delete-item:hover {
        text-decoration: underline;
    }

    .view-item {
        cursor: pointer;
    }
    .view-item:hover {
        text-decoration: underline;
    }
</style>
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
                    for ($i = 0; $i < sizeof($orders); ++$i) {
                        $order = $orders[$i];
                        $customer = $customerDAO->getCustomer(intval($order->userId));
                        $user = $userDAO->getUserById($order->userId);
                ?>
                        <tr class="table-item">
                            <td><?php echo $i ?></td>
                            <td class="order-number"><?php echo $order->orderNumber ?></td>
                            <td><?php echo $order->userId?></td>
                            <td><?php echo $user->userName?></td>
                            <td><?php echo $order->orderDate?></td>
                            <td><?php echo number_format($order->totalPrice, 0, ',', '.')?>đ</td>
                            <td><span class="view-item">Xem </span> | <span  class="delete-item"> Xóa</span></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    const orderDetailItems = document.querySelectorAll(".table-item");
    for (let i = 0; i < orderDetailItems.length; ++i) {
        orderDetailItems[i].querySelector('.delete-item').addEventListener('click', function(){
            var orderNumber = parseInt(orderDetailItems[i].querySelector(".order-number").innerHTML);
            openPostRequest("http://localhost/saleweb/admin/deleteorder", {
                orderNumber : orderNumber
            })
        })

        orderDetailItems[i].querySelector('.view-item').addEventListener('click', function() {
            var orderNumber = parseInt(orderDetailItems[i].querySelector(".order-number").innerHTML);
            openPostRequest("http://localhost/saleweb/admin/orderdetail", {
                orderNumber : orderNumber
            })
        }) 
    }
</script>