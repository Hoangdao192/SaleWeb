<?php
$user = $data['user'];
$orders = $data['orders'];
?>

<style>
    .delete-order {
        cursor: pointer;
    }
    .delete-order:hover {
        text-decoration: underline;
    }

    .view-order {
        cursor: pointer;
    }
    .view-order:hover {
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
                            <td><span class="view-order">Xem chi tiết</span> | <span class="delete-order">Hủy đơn</span></td>
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
        orderDetailItems[i].querySelector(".view-order").addEventListener('click', function(){
            var orderNumber = parseInt(orderDetailItems[i].querySelector(".order-number").innerHTML);
            openPostRequest(`${getDomainUrl()}/user/orderdetail`, {
                orderNumber : orderNumber
            })
        })

        orderDetailItems[i].querySelector(".delete-order").addEventListener('click', function(){
            var orderNumber = parseInt(orderDetailItems[i].querySelector(".order-number").innerHTML);
            openPostRequest(`${getDomainUrl()}/user/deleteorder`, {
                orderNumber : orderNumber
            })
        })
    }
</script>