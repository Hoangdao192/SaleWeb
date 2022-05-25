var now = new Date();
// var hour = now.getHours();
// var minute = now.getMinutes();
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