//---------------------------------------------------Select quantity-------------------------------------------------------------------

const increaseItem = document.querySelectorAll(".number-increase")
const decreaseItem = document.querySelectorAll(".number-decrease")
const numberInput = document.querySelectorAll(".number input")
const tipQuantity = document.querySelectorAll(".tip-quantity")
var index = 0

increaseItem.forEach(function(increase, index) {
    increaseItem[index].addEventListener("click", function() {
        let x = numberInput[index].getAttribute("value");
        if (x <= 10) {
            x++;
            numberInput[index].setAttribute("value", x);
            tipQuantity[index].style.opacity = "0"
            if (x == 11) {
                tipQuantity[index].innerHTML = "Số lượng không vượt quá 10"
                tipQuantity[index].style.opacity = "1"
            }
        }
    })
})

decreaseItem.forEach(function(increase, index) {
    decreaseItem[index].addEventListener("click", function() {
        let x = numberInput[index].getAttribute("value");
        if (x >= 1) {
            x--;
            numberInput[index].setAttribute("value", x);
            tipQuantity[index].style.opacity = "0"
            if (x == 0) {
                tipQuantity[index].innerHTML = "Số lượng không nhỏ hơn 1"
                tipQuantity[index].style.opacity = "1"
            }
        }
    })
})