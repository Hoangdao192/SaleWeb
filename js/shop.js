// Color item-----------------------------------------------------------------------------------------------------------------------

const labelItem = document.querySelectorAll(".category__right__content_item_text label")
const inputItem = document.querySelectorAll(".category__right__content_item_text input")
let index = 0

labelItem.forEach(function(label, index) {
    inputItem[index].addEventListener("click", function() {
        selectColor(index)
    })
})

function selectColor(index) {
    const doActive = document.querySelector(".active")
    if (doActive != null) {
        doActive.classList.remove("active")
    }
    labelItem[index].classList.add("active")
}

// display category__right--------------------------------------------------------------------------------------------------------

const contenCategotyItem = document.querySelectorAll(".category__left__content")
const headCategotyItem = document.querySelectorAll(".category__left__head")
let indexCategotyItem = -1

headCategotyItem.forEach(function(label, index) {
    headCategotyItem[index].addEventListener("click", function() {
        diplayContent(index)
        console.log("Click head!")
        console.log(index)
    })
})

function diplayContent(index) {
    const doActive = document.querySelector(".action")
    if (doActive != null) {
        doActive.classList.remove("action")
    }

    if (indexCategotyItem != index) {
        contenCategotyItem[index].classList.add("action")
        indexCategotyItem = index;
    } else {
        indexCategotyItem = -1;
    }
}

// select__size-----------------------------------------------------------------------------------------------------------------

const labelSizeItem = document.querySelectorAll(".category__left__content__size label")
let indexSize = 0

labelSizeItem.forEach(function(label, indexSize) {
    labelSizeItem[indexSize].addEventListener("click", function() {
        selectSize(indexSize)
        console.log("Click size!")
        console.log(indexSize)
    })
})

function selectSize(indexSize) {
    const doActive = document.querySelector(".select__size")
    if (doActive != null) {
        doActive.classList.remove("select__size")
    }
    labelSizeItem[indexSize].classList.add("select__size")
}