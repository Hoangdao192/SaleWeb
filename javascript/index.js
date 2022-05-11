const menuHome = document.querySelector(".menu__home");
menuHome.classList.add("menu__item__underline");

function addToCart(productId, productSize, colorradio_group_id, colorArray) {
    console.log(productId);

    //  Get selected color
    var radioGroup = document.getElementById(colorradio_group_id);
    console.log(radioGroup);
    var radioArray = radioGroup.querySelectorAll(".radio");
    console.log(radioArray);
    var productColor;
    for (let i = 0; i < radioArray.length; i++) {
        if (radioArray[i].checked) {
            productColor = radioArray[i].value;
        }
    }

    console.log(productId + " " + productSize + " " + productColor);

    var request = new XMLHttpRequest();
    request.open('POST', 'app/database/ShoppingCart.php', true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    request.onload = function() {
        if (this.status >= 200 && this.status < 400) {
            // Success!
            document.getElementById("cart-product-number").innerHTML = this.response;
            toast({
                title: "Đã thêm vào giỏ hàng",
                message:  ""
            });
        }
    };
    request.send(`action=add&productId=${productId}&productSize=${productSize}&productColor=${productColor}&productQuantity=1`);
}

function showProductDetail(productId) {
    console.log("clicked");
    window.location.href = "./product?productId=" + productId;
}

//---------------------------------------------------Change poster-------------------------------------------------------------------

const imgPosition = document.querySelectorAll(".aspect-ratio-169 img")
const imgContainer = document.querySelector(".aspect-ratio-169")
const dotItem = document.querySelectorAll(".dot")
const textHero = document.querySelector(".hero-text")
let imgNumber = imgPosition.length
let index = 0;

imgPosition.forEach(function(image, index) {
    /*console.log(image, index)*/
    image.style.left = index * 100 + "%";
    dotItem[index].addEventListener("click", function() {
        slider(index);
    })
})

function imgSlide() {
    index++;
    if (index >= imgNumber) {
        index = 0;
    }
    slider(index);
}

function slider(index) {
    imgContainer.style.left = "-" + index * 100 + "%";
    textHero.style.left = "+" + index * 100 + "%";
    const dotActive = document.querySelector(".active");
    dotActive.classList.remove("active");
    dotItem[index].classList.add("active");
}


setInterval(imgSlide, 5000)

//---------------------------------------------------Select product-------------------------------------------------------------------------

var productItem = document.getElementById("product-content-best-seller");
productItem.classList.add("show-product");
var productNew = document.getElementById("product-content-new-product");
productNew.classList.add("hide-product");
var productHotSale = document.getElementById("product-content-hot-sales");
productHotSale.classList.add("hide-product");

var bestSaleOption = document.querySelector("#best-sellers");
var newArrOption = document.querySelector("#new-arrivals");
var hotSaleOption = document.querySelector("#hot-sales");

bestSaleOption.addEventListener("click", function() {
    bestSaleOption.style.color = "#111"
    newArrOption.style.color = "#b7b7b7"
    hotSaleOption.style.color = "#b7b7b7"

    productItem.classList.add("show-product");
    productItem.classList.remove("hide-product");

    productNew.classList.add("hide-product");
    productNew.classList.remove("show-product");

    productHotSale.classList.add("hide-product");
    productHotSale.classList.remove("show-product");
});

newArrOption.addEventListener("click", function() {
    bestSaleOption.style.color = "#b7b7b7"
    newArrOption.style.color = "#111"
    hotSaleOption.style.color = "#b7b7b7"
    
    productNew.classList.add("show-product");
    productNew.classList.remove("hide-product");

    productItem.classList.add("hide-product");
    productItem.classList.remove("show-product");

    productHotSale.classList.add("hide-product");
    productHotSale.classList.remove("show-product");
});

hotSaleOption.addEventListener("click", function() {
    bestSaleOption.style.color = "#b7b7b7"
    newArrOption.style.color = "#b7b7b7"
    hotSaleOption.style.color = "#111"
    
    productHotSale.classList.add("show-product");
    productHotSale.classList.remove("hide-product");

    productItem.classList.add("hide-product");
    productItem.classList.remove("show-product");

    productNew.classList.add("hide-product");
    productNew.classList.remove("show-product");
});

//---------------------------------------------------Change color product-------------------------------------------------------------------


const labelItem = document.querySelectorAll(".product-item__text label")
const inputItem = document.querySelectorAll(".product-item__text input")
let indexColorItem = 0

labelItem.forEach(function(label, indexColorItem) {
    inputItem[indexColorItem].addEventListener("click", function() {
        selectColor(indexColorItem)
    })
})

function selectColor(indexColorItem) {
    const doActive = document.querySelector(".active")
    if (doActive != null) {
        doActive.classList.remove("active")
    }
    labelItem[indexColorItem].classList.add("active")
}

//---------------------------------------------------Countdown time-------------------------------------------------------------------

var count = 2592000;
const day = document.getElementById("dd");
const hour = document.getElementById("hh");
const mimute = document.getElementById("mm");
const second = document.getElementById("ss");
var time = 0;

function countdown() {
    ++time;
    count -= 1;
    if (count == 0) {
        count = 2592000;
    }
    var medium = count;
    second.innerHTML = medium % 60;
    medium = Math.floor(medium /= 60);
    mimute.innerHTML = medium % 60;
    medium = Math.floor(medium /= 60);
    hour.innerHTML = medium % 24;
    medium = Math.floor(medium /= 24);
    day.innerHTML = medium;
}

setInterval(countdown, 1000);