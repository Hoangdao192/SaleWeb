const moreButtons = document.querySelectorAll(".more");
const subMenus = document.querySelectorAll(".content-left-sub-menu");
console.log(moreButtons.length);
console.log(subMenus.length);
for (let i = 0; i < moreButtons.length; i++) {
    moreButtons[i].addEventListener("click", function() {
        console.log(i);
        moreButtons[i].classList.toggle("content-left-item-arrow-rotate");
        subMenus[i].classList.toggle("show-sub-menu");
    });
}

const orderButton = document.getElementById("order-button");
orderButton.addEventListener('click', function() {
    console.log("click");
    window.location.href = `${getDomainUrl()}/user/order`;
})

const profileButton = document.getElementById("profile-button");
profileButton.addEventListener('click', function(){
    window.location.href = `${getDomainUrl()}/user/profile`;
})

const homeButton = document.getElementById("home-button");
homeButton.addEventListener('click', function () {
    window.location.href = `${getDomainUrl()}/home`;
})

const shippingButton = document.getElementById("shipping-button");
shippingButton.addEventListener('click', function(){
    window.location.href = `${getDomainUrl()}/user/showshippingaddress`;
})