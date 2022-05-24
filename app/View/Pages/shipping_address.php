<?php

use Core\HTML;
$userId = json_decode($data['user'])->userId;
?>

<link rel="stylesheet" href="<?php echo HTML::style("shipping_address.css") ?>">
<input type="hidden" id="user-id-input" value="<?php echo $userId?>">
<div class="admin-content-right">
    <h3>Địa chỉ giao hàng</h3>
    <div class="all-address">
        <input class="address-radio" type="radio" style="display: none;" value="id" name="shpping-address" id="shipping-address-id">
        <label class="shipping-address-label" for="shipping-address-id">
            <div class="ring"></div>
            <div class="label-detail">
                <p>Người nhận: </p>
                <p>Số điện thoại</p>
                <p>Địa chỉ</p>
            </div>
        </label>
    </div>
    <button class="create-address secondary-button">ĐỊA CHỈ MỚI</button>
    <div class="detail-address new-address">
        <form action="" id="your-form">
            <input type="text" required id="name" name="name" placeholder="Họ tên" title="Chứa từ 1-32 ký tự a-z, A-Z, khoảng trắng. VD: Lê Xuân Vinh">
            <div class="telephone">
                <input type="tel" required id="phone" name="phone" placeholder="Số điện thoại" pattern="[0-9]{10,13}" title="Số điện thoại chứa từ 10-13 chữ số VD: 0123-456-789">
            </div>

            <select name="province-city" id="province-city" onchange="provinceSelected()">
            </select>
            <div class="telephone telephone__validate">
                <input type="text" required id="validate-code" name="validate-code" placeholder="Nhập mã xác minh">
                <p class="telephone__validate__ok" validated="0">OK</p>
            </div>

            <select name="district" id="district" onchange="districtSelected()">
                <option value="-1">Quận/Huyện</option>
            </select>
            <select name="wards" id="wards">
                <option value="-1">Xã/Phường</option>
            </select>
            <input type="text" required name="address" id="address" placeholder="Thôn/Bản/Tổ dân phố/Đường/Số nhà">
            <button class="save-address secondary-button">LƯU</button>
        </form>
    </div>
</div>
<script>
    loadShippingAddress();

    const createAddressButton = document.querySelector(".create-address");
    const createAddressForm = document.querySelector(".new-address");
    createAddressButton.addEventListener('click', function() {
        createAddressButton.style.display = "none";
        createAddressForm.style.display = "block";
    })

    const saveAddressButton = document.querySelector(".save-address");
    saveAddressButton.addEventListener('click', function() {
        if (!validate()) return;

        var receiverName = document.getElementById("name").value;
        var receiverPhone = document.getElementById("phone").value;

        const provinceSelector = document.getElementById("province-city");
        var province = provinceSelector.options[provinceSelector.selectedIndex].text;
        const districtSelector = document.getElementById("district");
        var district = districtSelector.options[districtSelector.selectedIndex].text;
        const wardSelector = document.getElementById("wards");
        var ward = wardSelector.options[wardSelector.selectedIndex].text;

        var detailAddress = document.getElementById("address").value;

        console.log(receiverName + " " + receiverPhone + " " + province + "-" + district + "-" + ward);
        var address = province + ", " + district + ", " + ward + ", " + detailAddress;

        var request = new XMLHttpRequest();
        request.open('POST', 'http://localhost/saleweb/user/addshippingaddress', true);
        request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        request.onload = function() {
            console.log(this.response)
            if (this.status >= 200 && this.status < 400) {
                createAddressForm.style.display = "none";
                createAddressButton.style.display = "block";
            }
        };
        request.send(`receiverName=${receiverName}&receiverPhoneNumber=${receiverPhone}&address=${address}`);
        loadShippingAddress();
    })

    function loadShippingAddress() {
        var addressContainer = document.querySelector(".all-address");
        let userId = document.getElementById("user-id-input").value;
        var request = new XMLHttpRequest();
        request.open('POST', `${getDomainUrl()}/ajax/delivery/showallshippingaddress2`, true);
        request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        request.onload = function() {
            console.log(this.response)
            if (this.status >= 200 && this.status < 400) {
                addressContainer.innerHTML = this.response;
                shippingItemEventHandle();
            }
        };
        request.send(`userId=${parseInt(userId)}`);
    }

    function shippingItemEventHandle() {
        const shippingAddressArray = document.querySelectorAll(".shipping-address-label");
        console.log(shippingAddressArray);
        for (let i = 0; i < shippingAddressArray.length; ++i) {
            var shippingAddress = shippingAddressArray[i];
            console.log(shippingAddress);
            let shippingAddressId = parseInt(shippingAddress.querySelector(".shipping-id").value);
            console.log(shippingAddress.querySelector(".shipping-id"));
            var deleteButton = shippingAddress.querySelector(".tool__delete");
            console.log(deleteButton);
            deleteButton.addEventListener('click', function() {
                console.log(shippingAddressId);
                var request2 = new XMLHttpRequest();
                request2.open('POST', `${getDomainUrl()}/ajax/delivery/deleteshippingaddress`, true);
                request2.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                request2.onload = function() {
                    if (this.status >= 200 && this.status < 400) {
                        loadShippingAddress();
                    }
                }
                request2.send(`shippingAddressId=${shippingAddressId}`);
            });
        }
    }

    function validate() {
        const provinceSelector = document.getElementById("province-city");
        var provinceId = provinceSelector.options[provinceSelector.selectedIndex].value;
        const districtSelector = document.getElementById("district");
        var districtId = districtSelector.options[districtSelector.selectedIndex].value;
        const wardSelector = document.getElementById("wards");
        var wardId = wardSelector.options[wardSelector.selectedIndex].value;

        if (parseInt(provinceId) == -1) {
            toast({
                title: "Bạn chưa chọn Tỉnh/Thành phố",
                description: ""
            })
            return false;
        } else if (parseInt(districtId) == -1) {
            toast({
                title: "Bạn chưa chọn Quận/Huyện",
                description: ""
            })
            return false;
        } else if (parseInt(wardId) == -1) {
            toast({
                title: "Bạn chưa chọn Xã/Phường",
                description: ""
            })
            return false;
        }
        return true;
    }

    ///////////////////////////////////////////////////
    //------------------On ready---------------------//
    ///////////////////////////////////////////////////
    if (document.readyState != 'loading') {
        loadProvince();
        loadShippingAddress();
    } else {
        document.addEventListener('DOMContentLoaded', function() {
            loadProvince();
            loadShippingAddress();
        });
    }
    //-----------------------------------------------//

    function provinceSelected() {
        var provinceSelector = document.getElementById("province-city");
        var provinceCode = provinceSelector.options[provinceSelector.selectedIndex].value;
        loadDistrict(provinceCode);
    }

    function districtSelected() {
        var districtSelector = document.getElementById("district");
        var districtCode = districtSelector.options[districtSelector.selectedIndex].value;
        loadWards(districtCode);
    }

    function loadProvince() {
        var request = new XMLHttpRequest();
        request.open('GET', 'https://provinces.open-api.vn/api/?depth=1', true);

        request.onload = function() {
            if (this.status >= 200 && this.status < 400) {
                // Success!
                var data = JSON.parse(this.response);
                var container = document.getElementById("province-city");
                //  Default select
                var item = document.createElement('option');
                item.classList.add("default-select");
                item.value = "-1"
                item.innerHTML = "Tỉnh/Thành phố";
                item.style.color = "grey";
                container.appendChild(item);

                for (let i = 0; i < data.length; ++i) {
                    var item = document.createElement('option');
                    item.value = parseInt(data[i]['code']);
                    item.innerHTML = data[i]['name'];
                    container.appendChild(item);
                }
            }
        };
        request.send();
    }

    function loadDistrict(provinceCode) {
        var request = new XMLHttpRequest();
        request.open('GET', `https://provinces.open-api.vn/api/p/${provinceCode}?depth=2`, true);

        request.onload = function() {
            if (this.status >= 200 && this.status < 400) {
                // Success!
                var data = JSON.parse(this.response);
                data = data['districts'];
                var container = document.getElementById("district");
                container.innerHTML = "";
                console.log(data);
                var item = document.createElement('option');
                item.innerHTML = "Quận/Huyện";
                item.value = "-1";
                item.classList.add("default-select");
                container.appendChild(item);
                for (let i = 0; i < data.length; ++i) {
                    var item = document.createElement('option');
                    item.value = parseInt(data[i]['code']);
                    item.innerHTML = data[i]['name'];
                    container.appendChild(item);
                }
            } else {
                // We reached our target server, but it returned an error

            }
        };
        request.send();
    }

    function loadWards(districtsCode) {
        var request = new XMLHttpRequest();
        request.open('GET', `https://provinces.open-api.vn/api/d/${districtsCode}?depth=2`, true);

        request.onload = function() {
            if (this.status >= 200 && this.status < 400) {
                // Success!
                var data = JSON.parse(this.response);
                data = data['wards'];
                var container = document.getElementById("wards");
                container.innerHTML = "";
                console.log(data);
                var item = document.createElement('option');
                item.classList.add("default-select");
                item.style.color = "grey";
                item.innerHTML = "Xã/Phường";
                item.value = -1;
                container.appendChild(item);
                for (let i = 0; i < data.length; ++i) {
                    var item = document.createElement('option');
                    item.value = parseInt(data[i]['code']);
                    item.innerHTML = data[i]['name'];
                    container.appendChild(item);
                }
            } else {
                // We reached our target server, but it returned an error

            }
        };
        request.send();
    }
</script>