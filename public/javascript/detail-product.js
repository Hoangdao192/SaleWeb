/* Select size */
const sizeItem = document.querySelectorAll(".detail-product__size span")
    // const inputItem = document.querySelectorAll(".detail-product__color__input input")
let indexSize = 0

sizeItem.forEach(function(size, indexSize) {
    sizeItem[indexSize].addEventListener("click", function() {
        selectSize(indexSize)
    })
})

function selectSize(indexSize) {
    const doActive = document.querySelector(".select-size")
    if (doActive != null) {
        doActive.classList.remove("select-size")
    }
    sizeItem[indexSize].classList.add("select-size")
}

/* Select quantity */
const increaseItem = document.querySelector(".number-increase")
const decreaseItem = document.querySelector(".number-decrease")
const numberInput = document.querySelector(".number input")

increaseItem.addEventListener("click", function() {
    let x = numberInput.getAttribute("value");
    if (x < 10) {
        x++;
        numberInput.setAttribute("value", x);
    } else {
        toast({
            title: "Số lượng không thể vượt quá 10",
            description: ""
        })
    }
})

decreaseItem.addEventListener("click", function() {
    let x = numberInput.getAttribute("value");
    if (x > 1) {
        x--;
        numberInput.setAttribute("value", x);
    } else {
        toast({
            title: "Số lượng không thể nhỏ hơn 1",
            description: ""
        })
    }
})

function addToCart(productId, productSize, colorRadioGroupId, quantity) {
    //  Get selected color
    var radioGroup = document.getElementById(colorRadioGroupId);
    var radioArray = radioGroup.querySelectorAll(".radio");
    var productColor;
    for (let i = 0; i < radioArray.length; i++) {
        if (radioArray[i].checked) {
            productColor = radioArray[i].value;
        }
    }

    console.log(productId + " " + productSize + " " + productColor + " " + quantity);
    $.ajax({
        type: 'post',
        url: `${getDomainUrl()}/ajax/shopingcart/add`,
        data: {
            action: 'add',
            productId: productId,
            productSize: productSize,
            productColor: productColor,
            productQuantity: quantity
        },
        success: function(response) {
            console.log(response);
            var decodeJSON = JSON.parse(response);
            console.log(decodeJSON);
            // Success!
            if (decodeJSON.status == "success") {
                document.getElementById("cart-product-number").innerHTML = decodeJSON.numberOfItem;
                toast({
                    title: "Đã thêm vào giỏ hàng",
                    message:  ""
                });
            } else {
                var message = decodeJSON.message;
                toast({
                    title: message,
                    message:  ""
                });
            }
        }
    });
}

function showProductDetail(productId) {
    openPostRequest(`${getDomainUrl()}/productdetail`, {
        productId : productId
    })
}

function buyNow(productId, productSize, colorRadioGroupId, quantity) {
    //  Get size
    var allSizeElement = document.querySelectorAll(".detail-product__size span");
        for (let i = 0; i < allSizeElement.length; ++i) {
            if (allSizeElement[i].classList.contains("select-size")) {
                productSize = allSizeElement[i].innerHTML;
            }
        }

    //  Quantity
    var inputQuantity = document.querySelector(".detail-product__quantity input");
    addToCart(productId, productSize, colorRadioGroupId, parseInt(inputQuantity.value));
    window.location.href = `${getDomainUrl()}/cart`;
}

function addToCartMain(productId, productSize, colorRadioGroupId, quantity) {
    //  Get size
    var allSizeElement = document.querySelectorAll(".detail-product__size span");
        for (let i = 0; i < allSizeElement.length; ++i) {
            if (allSizeElement[i].classList.contains("select-size")) {
                productSize = allSizeElement[i].innerHTML;
            }
        }

    //  Quantity
    var inputQuantity = document.querySelector(".detail-product__quantity input");
    addToCart(productId, productSize, colorRadioGroupId, parseInt(inputQuantity.value));
}
