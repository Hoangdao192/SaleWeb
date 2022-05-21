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