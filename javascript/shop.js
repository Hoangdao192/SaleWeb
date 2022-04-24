const arrowButton = document.querySelector(".show-categories");
document.querySelector(".categories-sub-menu").classList.add("categories-sub-menu-show");
arrowButton.addEventListener("click", function(){
    document.querySelector(".categories-sub-menu").classList.toggle("categories-sub-menu-show");
});

var productItems = document.querySelectorAll(".product-item img");
console.log(productItems);
for (let i = 0; i < productItems.length; ++i) {
    productItems[i].addEventListener("click", function(){
        console.log("clicked");
        window.location.href = "../product_detail.php?productId=1";
    })
}