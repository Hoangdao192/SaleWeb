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