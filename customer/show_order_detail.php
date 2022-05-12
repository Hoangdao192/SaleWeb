<?php
include "header.php";
include "slider.php";

include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/OrderTable.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/OrderDetailTable.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/ProductTable.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/CustomerTable.php";
?>

<?php
$orderNumber = intval($_GET['orderNumber']);

$orderDetailTable = new OrderDetailTable();
$orderDetails = $orderDetailTable->getAllFilterByOrderNumber($orderNumber);

$productTable = new ProductTable();

$orderTable = new OrderTable();
$order = $orderTable->getOrder($orderNumber);
?>

<div class="admin-content-right">
    <div class="admin-content-right-cartegory-list">
        <h1>Chi tiết đơn hàng</h1>
        <h3>Mã đơn hàng: <?php echo $order->orderNumber?></h3>
        <h3>Ngày đặt: <?php echo $order->orderDate?></h3>
        <h3>Tổng tiền: <?php echo number_format($order->totalPrice, 0, ',', '.')?>đ</h3>
        <table class="content-table">
            <thead class="table-head">
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Kích cỡ</th>
                    <th>Màu sắc</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($orderDetails) {
                    for ($i = 0; $i < sizeof($orderDetails); ++$i) {
                        $orderDetail = $orderDetails[$i];
                        $product = $productTable->getProduct($orderDetail->productId);
                ?>
                        <tr class="table-item">
                            <td><?php echo $i ?></td>
                            <td><?php echo $product->name?></td>
                            <td class="image-container">
                                <img class="product-image" src="../admin/database/<?php echo $product->imagePath?>" alt="">
                            </td>
                            <td><?php echo $orderDetail->productSize?></td>
                            <td>
                                <div class="color-item" style="background-color: <?php echo $orderDetail->productColor?>;"></div>
                            </td>
                            <td><?php echo number_format($orderDetail->priceEach, 0, ',', '.')?>đ</td>
                            <td><?php echo $orderDetail->quantityOrdered?></td>
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

</html>