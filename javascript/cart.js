calculateTotalMoney();

function productItemEventHandle() {
    let allProduct = document.querySelectorAll(".content-item");
    for (let i = 0; i < allProduct.length; ++i) {
        let increaseItem = allProduct[i].querySelector(".number-increase");
        let numberInput =  allProduct[i].querySelector(".number input");
        let decreaseItem = allProduct[i].querySelector(".number-decrease");
        let tipQuantity = allProduct[i].querySelector(".tip-quantity");
        let totalPurchase = allProduct[i].querySelector(".product_total_money");
        let productPrice = allProduct[i].querySelector(".product_price");
        let deleteProductButton = allProduct[i].querySelector(".delete-product");

        increaseItem.addEventListener("click", function() {
            let x = numberInput.getAttribute("value");
            if (x < 10) {
                x++;
                numberInput.setAttribute("value", x);
                tipQuantity.style.opacity = "0"
                if (x == 11) {
                    tipQuantity.innerHTML = "Số lượng không vượt quá 10"
                    tipQuantity.style.opacity = "1"
                }
            }
            let formatter = new Intl.NumberFormat('de-DE');
            totalPurchase.innerHTML = formatter.format(x * productPrice.value);
            calculateTotalMoney();
        })

        decreaseItem.addEventListener("click", function() {
            let x = numberInput.getAttribute("value");
            if (x > 1) {
                x--;
                numberInput.setAttribute("value", x);
                tipQuantity.style.opacity = "0"
                if (x == 0) {
                    tipQuantity.innerHTML = "Số lượng không nhỏ hơn 1"
                    tipQuantity.style.opacity = "1"
                }
            }
            let formatter = new Intl.NumberFormat('de-DE');
            totalPurchase.innerHTML = formatter.format(x * productPrice.value);
            calculateTotalMoney();
        })

        deleteProductButton.addEventListener('click', function(){
            deleteProduct(i);
        });
    }
}

function calculateTotalMoney() {
    let money = 0;
    let totalMoney = document.querySelector(".total_money");
    let allProduct = document.querySelectorAll(".content-item");

    for (let i = 0; i < allProduct.length; ++i) {
        let numberInput =  allProduct[i].querySelector(".number input");
        let productPrice = allProduct[i].querySelector(".product_price");
        money += parseInt(numberInput.value) * parseInt(productPrice.value);
    }
    console.log(money);
    
    let formatter = new Intl.NumberFormat('de-DE');
    totalMoney.innerHTML = formatter.format(money);
    return money;
}

function deleteProduct(index) {
    console.log(index);
    var request = new XMLHttpRequest();
     request.open('GET', `app/database/shopping_cart.php?action=delete&index=${index}`, true);

     request.onload = function() {
         if (this.status >= 200 && this.status < 400) {
             // Success!
             loadCart();
         }
     };
     request.send();
}

document.querySelector(".order_field").addEventListener('click', function(){
    let totalMoney = document.querySelector(".total_money");
    console.log(calculateTotalMoney());
    let location = "delivery.php?totalPurchase=" + calculateTotalMoney()
    window.location.href = location;
});

if (document.readyState != 'loading') {
    loadCart();
 } else {
     document.addEventListener('DOMContentLoaded', loadCart());
 }

 function loadCart() {
     var request = new XMLHttpRequest();
     request.open('GET', 'app/database/shopping_cart.php?action=load', true);

     request.onload = function() {
         if (this.status >= 200 && this.status < 400) {
             // Success!
             var productContainer = document.getElementById("product-container");
             productContainer.innerHTML = this.response;
             productItemEventHandle();
             calculateTotalMoney();
         }
     };
     request.send();
 }