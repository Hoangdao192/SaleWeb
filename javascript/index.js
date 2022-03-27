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

const productItem = document.querySelectorAll(".product-item")
const productNewArrItem = document.querySelectorAll(".new-arr")
const productHotSaleItem = document.querySelectorAll(".hot-sale")
const bestSaleOption = document.querySelector("#best-sellers")
const newArrOption = document.querySelector("#new-arrivals")
const hotSaleOption = document.querySelector("#hot-sales")

bestSaleOption.addEventListener("click", function() {
    bestSaleOption.style.color = "#111"
    newArrOption.style.color = "#b7b7b7"
    hotSaleOption.style.color = "#b7b7b7"
    productItem.forEach(function(product) {
        product.classList.remove("product-item-smaller")
        product.classList.remove("product-item-transiton")
    })
})

newArrOption.addEventListener("click", function() {
    bestSaleOption.style.color = "#b7b7b7"
    newArrOption.style.color = "#111"
    hotSaleOption.style.color = "#b7b7b7"
    productItem.forEach(function(product) {
        product.classList.remove("product-item-smaller")
    })
    productHotSaleItem.forEach(function(product) {
        product.classList.add("product-item-smaller")
        product.classList.add("product-item-transiton")
    })
})

hotSaleOption.addEventListener("click", function() {
    bestSaleOption.style.color = "#b7b7b7"
    newArrOption.style.color = "#b7b7b7"
    hotSaleOption.style.color = "#111"
    productItem.forEach(function(product) {
        product.classList.remove("product-item-smaller")
    })
    productNewArrItem.forEach(function(product) {
        product.classList.add("product-item-smaller")
        product.classList.add("product-item-transiton")
    })
})

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
    console.log(++time);
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