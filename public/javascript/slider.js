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
    window.location.href = `${getDomainUrl()}/admin/order`;
})

const customerButton = document.getElementById("customer-button");
customerButton.addEventListener('click', function(){
    console.log("click");
    window.location.href = `${getDomainUrl()}/admin/customer`;
})

const statiticButton = document.getElementById("statitics-button");
statiticButton.addEventListener('click', function(){
    console.log("click");
    window.location.href = `${getDomainUrl()}/admin/analytic`;
})

