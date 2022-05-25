// Select main image-----------------------------------------------------------------------------------------------------------------------

const mainImg = document.querySelector(".detail-product-image-main img")
const imgItem = document.querySelectorAll(".detail-product-image-category li img")
let indexImg = 0

imgItem.forEach(function(image, indexImg) {
    image.addEventListener("click", function() {
        mainImg.src = image.src;
    })
})

const arrowUp = document.querySelector(".detail-product-image-category .arrow-up")
const arrowDown = document.querySelector(".detail-product-image-category .arrow-down")
const listImg = document.querySelectorAll(".detail-product-image-category li")

let indexImgUp = 0
let indexImgDown = 2
let sizeListImg = listImg.length

arrowUp.addEventListener("click", function(arrow) {
    console.log("Up")
    if (indexImgUp > 0) {
        indexImgUp -= 1
        indexImgDown -= 1
        listImg[indexImgUp].classList.add("view")
        listImg[indexImgDown + 1].classList.remove("view")
    }
})

arrowDown.addEventListener("click", function(arrow) {
    console.log("Down")
    if (indexImgDown < sizeListImg - 1) {
        indexImgUp += 1
        indexImgDown += 1
        listImg[indexImgUp - 1].classList.remove("view")
        listImg[indexImgDown].classList.add("view")
    }
})



// Color item-----------------------------------------------------------------------------------------------------------------------

const labelItem = document.querySelectorAll(".detail-product__color__input label")
const inputItem = document.querySelectorAll(".detail-product__color__input input")
const nameColor = document.querySelector(".detail-product__color span")
let index = 0
const blue = document.querySelector(".label__blue");
const black = document.querySelector(".label__black");
const gray = document.querySelector(".label__gray");


labelItem.forEach(function(label, index) {
    inputItem[index].addEventListener("click", function() {
        selectColor(index)
    })
})

function selectColor(index) {
    const doActive = document.querySelector(".select-color")
    if (doActive != null) {
        doActive.classList.remove("select-color")
    }

    labelItem[index].classList.add("select-color")

    if (labelItem[index] == blue) {
        document.querySelector(".detail-product__color span").innerHTML = "Xanh da trời"
    }

    if (labelItem[index] == black) {
        document.querySelector(".detail-product__color span").innerHTML = "Đen"
    }

    if (labelItem[index] == gray) {
        document.querySelector(".detail-product__color span").innerHTML = "Xám"
    }
}

//---------------------------------------------------Select size-------------------------------------------------------------------

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

//---------------------------------------------------Select quantity-------------------------------------------------------------------

const increaseItem = document.querySelector(".number-increase")
const decreaseItem = document.querySelector(".number-decrease")
const numberInput = document.querySelector(".number input")

increaseItem.addEventListener("click", function() {
    let x = numberInput.getAttribute("value");
    if (x < 10) {
        x++;
        numberInput.setAttribute("value", x);
    } else {
        alert("Số lượng không thể vượt quá 10")
    }
})

decreaseItem.addEventListener("click", function() {
    let x = numberInput.getAttribute("value");
    if (x > 1) {
        x--;
        numberInput.setAttribute("value", x);
    } else {
        alert("Số lượng không thể nhỏ hơn 1")
    }
})

//---------------------------------------------------Detail product menu-------------------------------------------------------------------

const tapItem = document.querySelectorAll(".detail-product__tap-header .tap-item")
const tapContent = document.querySelectorAll(".detail-product__tap-body .tap-content")
const arrowMenu = document.querySelector(".detail-product__tap-body .arrow")
let indexTapItem = 0
let indexContentItem = 0;

tapItem.forEach(function(tap, indexTapItem) {
    tapItem[indexTapItem].addEventListener("click", function() {
        selectTap(indexTapItem)
    })
})

function selectTap(indexTapItem) {
    const doActive = document.querySelector(".select-tap")
    const doActive2 = document.querySelector(".shown")
    if (doActive != null && doActive2 != null) {
        doActive.classList.remove("select-tap")
        doActive2.classList.remove("shown")
    }
    tapItem[indexTapItem].classList.add("select-tap")
    indexContentItem = indexTapItem;
    tapContent[indexContentItem].classList.add("shown")
    arrowMenu.classList.remove("arrow-reverse")
}

//Show Content

arrowMenu.addEventListener("click", function() {
    const doActive = document.querySelector(".shown")
    const doActive2 = document.querySelector(".select-tap")
    if (doActive != null) {
        console.log("Not Null")
        doActive.classList.remove("shown")
        doActive2.classList.remove("select-tap")
        arrowMenu.classList.add("arrow-reverse")
    } else {
        console.log("Null")
        tapContent[indexContentItem].classList.add("shown")
        tapItem[indexContentItem].classList.add("select-tap")
        arrowMenu.classList.remove("arrow-reverse")
    }
})

//---------------------------------------------------Change color related product-------------------------------------------------------------------


const labelRelatedProduct = document.querySelectorAll(".product-item__text label")
const inputRelatedProduct = document.querySelectorAll(".product-item__text input")
let indexColorItem = 0

labelRelatedProduct.forEach(function(label, indexColorItem) {
    inputRelatedProduct[indexColorItem].addEventListener("click", function() {
        changeColor(indexColorItem)
    })
})

function changeColor(indexColorItem) {
    const doActive = document.querySelector(".active")
    if (doActive != null) {
        doActive.classList.remove("active")
    }
    labelRelatedProduct[indexColorItem].classList.add("active")
}