<?php
include "header.php";
include "slider.php";

include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/order_table.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/order_detail_table.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/product_table.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/customer_table.php";
?>

<?php
$order_number = intval($_GET['orderNumber']);

$order_detail_table = new OrderDetailTable();
$order_details = $order_detail_table->get_all_filter_by_order_number($order_number);

$product_table = new ProductTable();

$order_table = new OrderTable();
$order = $order_table->get_order($order_number);
?>

<div class="admin-content-right">
    <div class="admin-content-right-cartegory-list">
        <h1>Chi tiết đơn hàng</h1>
        <h3>Mã đơn hàng: <?php echo $order->order_number?></h3>
        <h3>Ngày đặt: <?php echo $order->order_date?></h3>
        <h3>Tổng tiền: <?php echo number_format($order->total_price, 0, ',', '.')?>đ</h3>
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
                if ($order_details) {
                    for ($i = 0; $i < sizeof($order_details); ++$i) {
                        $order_detail = $order_details[$i];
                        $product = $product_table->get_product($order_detail->product_id);
                ?>
                        <tr class="table-item">
                            <td><?php echo $i ?></td>
                            <td><?php echo $product->name?></td>
                            <td class="image-container">
                                <img class="product-image" src="../admin/database/<?php echo $product->image_path?>" alt="">
                            </td>
                            <td><?php echo $order_detail->product_size?></td>
                            <td>
                                <div class="color-item" style="background-color: <?php echo $order_detail->product_color?>;"></div>
                            </td>
                            <td><?php echo number_format($order_detail->price_each, 0, ',', '.')?>đ</td>
                            <td><?php echo $order_detail->quantity_ordered?></td>
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