const arrowButton = document.querySelector(".show-categories");
arrowButton.addEventListener("click", function(){
    document.querySelector(".categories-sub-menu").classList.toggle("categories-sub-menu-show");
});