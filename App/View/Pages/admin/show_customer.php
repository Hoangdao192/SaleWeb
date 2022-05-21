<?php
use App\Database\DAO\ProductTypeDAO;
use App\Database\DAO\ProductDAO;
use App\Database\DAO\CategoryDAO;

$customers = $data['customers'];
?>

<style>
    .customer-item__detail {
        cursor: pointer;
    }

    .customer-item__detail:hover {
        text-decoration: underline;
    }

    .customer-item__delete {
        cursor: pointer;
    }

    .customer-item__delete:hover {
        text-decoration: underline;
    }
</style>
<div class="admin-content-right">
    <div class="admin-content-right-cartegory-list">
        <h1>Danh sách khách hàng</h1>
        <table class="content-table">
            <thead class="table-head">
                <tr>
                    <th>STT</th>
                    <th>ID</th>
                    <th>Họ và tên</th>
                    <th>Ngày sinh</th>
                    <th>Giới tính</th>
                    <th>Tuổi</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Tùy biến</th>
                </tr>
            </thead>
            <tbody class="customer-container">
                <?php
                if ($customers) {
                    $i = 0;
                    for ($i = 0; $i < sizeof($customers); ++$i) {
                        $customer = $customers[$i];
                ?>
                        <tr class="customer-item">
                            <td><?php echo $i ?></td>
                            <td class="user-id"><?php echo $customer->userId?></td>
                            <td><?php echo $customer->customerName?></td>
                            <td><?php echo $customer->dateOfBirth?></td>
                            <td><?php echo $customer->gender?></td>
                            <td><?php echo $customer->age?></td>
                            <td><?php echo $customer->phoneNumber?></td>
                            <td><?php echo $customer->address?></td>
                            <td><span class="customer-item__detail">Chi tiết</span> | <span class="customer-item__delete">Xóa</span></td>
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
    loadCustomer();

    function evenHandle() {
        var customerItems = document.querySelectorAll(".customer-item");
        for (let i = 0; i < customerItems.length; ++i) {
            customerItems[i].querySelector(".customer-item__delete").addEventListener('click', function(){
                let userId = parseInt(customerItems[i].querySelector(".user-id").innerHTML);
                deleteCustomer(userId);
            })

            customerItems[i].querySelector(".customer-item__detail").addEventListener('click', function(){
                let userId = parseInt(customerItems[i].querySelector(".user-id").innerHTML);
                console.log('click');
                openPostRequest(`${getDomainUrl()}/admin/profilecustomer`, {
                    userId: userId
                })
            })
        }
    }

    function deleteCustomer(userId) {
        let request = new XMLHttpRequest();
        request.open("POST", `${getDomainUrl()}/admin/deletecustomer`);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        request.onload = function() {
            console.log(this.response);
            if (this.status >= 200 && this.status < 400) {
                loadCustomer();
            }
        }
        request.send(`userId=${userId}`);
    }

    function loadCustomer() {
        let request = new XMLHttpRequest();
        request.open("POST", `${getDomainUrl()}/admin/ajax/customer/all`);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        request.onload = function() {
            if (this.status >= 200 && this.status <= 400) {
                let container = document.querySelector(".customer-container");
                container.innerHTML = this.response;
                evenHandle();
            }
        }
        request.send();
    }
</script>
