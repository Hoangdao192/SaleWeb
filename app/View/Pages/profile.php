<?php
use Core\HTML;

$customer = $data['customer'];
?>

<link rel="stylesheet" href="<?php echo HTML::style("profile.css")?>">
<div class="admin-content-right">
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
    <div class="profile__button">
        <button class="edit-button button">Sửa</button>
        <button class="save-button button">Lưu</button>
    </div>
</div>
<script>
    var editButton = document.querySelector(".edit-button");
    var saveButton = document.querySelector(".save-button");
    var ageInput = document.querySelector(".profile__input__age");
    var nameInput = document.querySelector(".profile__input__name");
    var phoneInput = document.querySelector(".profile__input__phone");
    var addressInput = document.querySelector(".profile__input__address");
    var genderInput = document.querySelector(".profile__input__gender");
    var genderSelector = document.querySelector(".profile__select__gender");
    var birthDayInput = document.querySelector(".profile__input__birth");

    editButton.addEventListener('click', function(){
        console.log("CLICK");
        ageInput.removeAttribute('readonly');
        nameInput.removeAttribute('readonly');
        phoneInput.removeAttribute('readonly');
        addressInput.removeAttribute('readonly');
        genderInput.removeAttribute('readonly');
        birthDayInput.removeAttribute('readonly');
        genderInput.style.display = "none";
        genderSelector.style.display = 'inline-block';

        editButton.style.display = "none";
        saveButton.style.display = "block";
    })

    saveButton.addEventListener('click', function() {
        var request = new XMLHttpRequest();
        console.log(`customerName=${nameInput.value}&age=${ageInput.value}&phoneNumber=${phoneInput.value}` +
            `&gender=${genderSelector.value}&dateOfBirth=${birthDayInput.value}&address=${addressInput.value}`)
        request.open("POST", `${getDomainUrl()}/user/updateinformation`);
        request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        request.onload = function(){
            if (this.status >= 200 && this.status < 400) {
                toast({
                    title: "Đã lưu",
                    description: ""
                })

                ageInput.setAttribute('readonly', 'readonly');
                nameInput.setAttribute('readonly', 'readonly');
                phoneInput.setAttribute('readonly', 'readonly');
                addressInput.setAttribute('readonly', 'readonly');
                genderInput.setAttribute('readonly', 'readonly');
                birthDayInput.setAttribute('readonly', 'readonly');
                genderInput.style.display = "inline-block";
                genderSelector.style.display = 'none';

                editButton.style.display = "block";
                saveButton.style.display = "none";
            }
        }
        request.send(
            `customerName=${nameInput.value}&age=${ageInput.value}&phoneNumber=${phoneInput.value}` +
            `&gender=${genderSelector.options[genderSelector.selectedIndex].text}&dateOfBirth=${birthDayInput.value}&address=${addressInput.value}`
        );
    })
</script>

