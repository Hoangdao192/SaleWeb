const labelIeam = document.querySelectorAll(".label")
const inputIteam = document.querySelectorAll(".input")
let index = 0
let time = 0

labelIeam.forEach(function(label, index) {
    console.log(index)
    inputIteam[index].addEventListener("click", function() {
        selectColor(index)
        console.log("Click!")
    })
})

function selectColor(index) {
    const doActive = document.querySelector(".active")
    if (doActive != null) {
        doActive.classList.remove("active")
    }
    labelIeam[index].classList.add("active")
}