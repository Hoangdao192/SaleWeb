<?php
$shippingAddress = $data['shippingAddress'];
?>

<input required class="address-radio" type="radio" style="display: none;" value="<?php echo $shippingAddress->id?>" 
    name="shpping-address" id="shipping-address-<?php echo $shippingAddress->id?>">
<label class="shipping-address-label" for="shipping-address-<?php echo $shippingAddress->id?>">
    <div class="ring"></div>
    <div class="label-detail">
        <p><b>Người nhận:</b> <?php echo $shippingAddress->receiverName?></p>
        <p><b>Số điện thoại:</b> <?php echo $shippingAddress->receiverPhoneNumber?></p>
        <p><b>Địa chỉ:</b> <?php echo $shippingAddress->address?></p>
    </div>
</label>