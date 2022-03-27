const arrowButton = document.querySelector(".show-categories");
document.querySelector(".categories-sub-menu").classList.add("categories-sub-menu-show");
arrowButton.addEventListener("click", function(){
    document.querySelector(".categories-sub-menu").classList.toggle("categories-sub-menu-show");
});