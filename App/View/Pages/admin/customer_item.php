<?php
$customer = $data['customer'];
$index = $data['index'];
?>

<tr class="customer-item">
    <td><?php echo $index ?></td>
    <td class="user-id"><?php echo $customer->userId ?></td>
    <td><?php echo $customer->customerName ?></td>
    <td><?php echo $customer->dateOfBirth ?></td>
    <td><?php echo $customer->gender ?></td>
    <td><?php echo $customer->age ?></td>
    <td><?php echo $customer->phoneNumber ?></td>
    <td><?php echo $customer->address ?></td>
    <td><span class="customer-item__detail">Chi tiết</span> | <span class="customer-item__delete">Xóa</span></td>
</tr>