<?php
use Core\HTML;

$customer = $data['customer'];
$shippingAddressArray = $data['shippingAddressArray'];
$orders = $data['orders'];
?>

<link rel="stylesheet" href="<?php echo HTML::style("shipping_address.css") ?>">
<link rel="stylesheet" href="<?php echo HTML::style("profile.css")?>">
<style>
    .admin-content-right {
        background-color: transparent !important;
    }

    .profile-table {
        background-color: white;
        padding: 15px;
        border-radius: 5px;
    }

    .shipping-address {
        margin-top: 20px;
        background-color: white;
        padding: 15px;
        border-radius: 5px;
    }

    .all-order {
        margin-top: 20px;
        background-color: white;
        padding: 15px;
        border-radius: 5px;
    }
</style>
<div class="admin-content-right">  
    <div class="profile-table">
        <h1>Thông tin khách hàng</h1>
        <table class="profile-table">
            <tr class="profile--item">
                <td><p>Họ và tên</p></td>
                <td><input readonly class="profile__input profile__input__name" type="text" value="<?php echo $customer->customerName?>"></td>
            </tr>
            <tr class="profile--item">
                <td><p>Ngày sinh</p></td>
                <td><input readonly class="profile__input profile__input__birth" type="date" value="<?php echo $customer->dateOfBirth?>"></td>
            </tr>
            <tr class="profile--item">
                <td><p>Tuổi</p></td>
                <td><input readonly class="profile__input profile__input__age" type="text" value="<?php echo $customer->age?>"></td>
            </tr>
            <tr class="profile--item">
                <td><p>Giới tính</p></td>
                <td>
                    <input readonly class="profile__input profile__input__gender" type="text" value="<?php echo $customer->gender?>">
                    <select class="profile__select__gender" name="gender" id="gender">
                        <option value="">Nam</option>
                        <option value="">Nữ</option>
                        <option value="">Khác</option>
                    </select>
                </td>
            </tr>
            <tr class="profile--item">
                <td><p>Số điện thoại</p></td>
                <td><input readonly class="profile__input profile__input__phone" type="text" value="<?php echo $customer->phoneNumber?>"></td>
            </tr>
            <tr class="profile--item">
                <td><p>Địa chỉ</p></td>
                <td><input readonly class="profile__input profile__input__address" type="text" value="<?php echo $customer->address?>"></td>
            </tr>
        </table>
    </div>
    <div class="shipping-address">
        <h1>Địa chỉ vận chuyển</h1>
        <?php
        for ($i = 0; $i < sizeof($shippingAddressArray); ++$i) {
            $shippingAddress = $shippingAddressArray[$i];
            ?>
            <div class="shipping-address-label" style="display: block;">
            <input type="hidden" value="<?php echo $shippingAddress->id?>" class="shipping-id">
                <div class="label-detail">
                    <p><b>Người nhận:</b> <?php echo $shippingAddress->receiverName?></p>
                    <p><b>Số điện thoại:</b> <?php echo $shippingAddress->receiverPhoneNumber?></p>
                    <p><b>Địa chỉ:</b> <?php echo $shippingAddress->address?></p>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    <div class="all-order">
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
</div>