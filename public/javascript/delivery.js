///////////////////////////////////////////////////
//------------------On ready---------------------//
///////////////////////////////////////////////////
if (document.readyState != 'loading'){
    loadProvince();
} else {
    document.addEventListener('DOMContentLoaded', function(){
        loadProvince();
    });
}
//-----------------------------------------------//

function provinceSelected(){
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

// show list product-----------------------------------------------------------------------------------------------------------------------

const buttonShowProduct = document.querySelector(".button-show-product")
const productList = document.querySelector(".product-list")

buttonShowProduct.addEventListener("click", function() {
    const productListNotDisplay = document.querySelector(".not-display")
    if (productListNotDisplay == null) {
        productList.classList.add("not-display")
        console.log("true")
    } else {
        productListNotDisplay.classList.remove("not-display")
        console.log("false")
    }
})

/*Create order*/
const submitButton = document.getElementById("submit");
submitButton.addEventListener('click', function(){
    var request = new XMLHttpRequest();
    request.open('POST', 'http://localhost/saleweb/ajax/shopingcart/createorder', true);
    request.onload = function() {
        console.log(this.response);
        if (this.status >= 200 && this.status < 400) {
            console.log(this.response);
            window.location.href = "http://localhost/saleweb/shop";
        }
    };
    request.send();
})