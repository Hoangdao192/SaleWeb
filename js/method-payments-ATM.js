const bankItem = document.querySelectorAll(".images img")
var index = 0
var indexBank = 0

bankItem.forEach(function(item, index) {
    bankItem[index].addEventListener("click", function() {
        const doActive = document.querySelector(".bank-chosen")
        if (doActive != null) {
            doActive.classList.remove("bank-chosen")
        }
        if (index != indexBank) {
            bankItem[index].classList.add("bank-chosen")
            indexBank = index;
        }
    })
})