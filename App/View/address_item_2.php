<?php
$shippingAddress = $data['shippingAddress'];
?>

<div class="shipping-address-label">
    <input type="hidden" value="<?php echo $shippingAddress->id?>" class="shipping-id">
    <div class="label-detail">
        <p><b>Người nhận:</b> <?php echo $shippingAddress->receiverName?></p>
        <p><b>Số điện thoại:</b> <?php echo $shippingAddress->receiverPhoneNumber?></p>
        <p><b>Địa chỉ:</b> <?php echo $shippingAddress->address?></p>
        <div class="tool">
            <div class="tool__edit tool--item">
                <i class="fa-solid fa-pen-to-square"></i>
            </div>
            <div class="tool__delete tool--item">
                <i class="fa-solid fa-trash"></i>
            </div>
        </div>
    </div>
</div>