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

const submitButton = document.getElementById("submit");
submitButton.addEventListener('click', function(){
    var request = new XMLHttpRequest();
     request.open('GET', 'app/database/shopping_cart.php?action=order', true);

     request.onload = function() {
         if (this.status >= 200 && this.status < 400) {
         }
     };
     request.send();
})