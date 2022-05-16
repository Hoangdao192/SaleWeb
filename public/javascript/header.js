if (document.readyState != 'loading'){
    headerReady();
} else {
    document.addEventListener('DOMContentLoaded', headerReady());
}

function headerReady() {
    var request = new XMLHttpRequest();
    request.open('POST', 'http://localhost/saleweb/ajax/shopingcart/count', true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    request.onload = function() {
        if (this.status >= 200 && this.status < 400) {
            // Success!
            document.getElementById("cart-product-number").innerHTML = this.response;
        }
    };
    request.send();
}

function toast({
    title, message
}) {
    var toastContainer = document.getElementById("toast");
    var toastItem = document.createElement('div');
    toastItem.classList.add("toast-item");

    toastItem.innerHTML = `
        <div class="toast__check-icon">
            <i class="fa-solid fa-circle-check"></i>
        </div>
        <div class="toast__message">
        <p class="toast__message__title">${title}</p>
        </div>
        <i class="fa-solid fa-xmark toast__close-icon"></i>
    `;
    toastContainer.appendChild(toastItem);

    setTimeout(function (){
        toastContainer.removeChild(toastItem);
    }, 4000);
}