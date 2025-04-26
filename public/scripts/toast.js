const timeout = 5000; // Time it takes for the toast to disappear, in ms
// NOTE: Be sure to edit the css animation as well for the progress bar

function showToast(message, type = "info") {
    const toastContainer = document.querySelector(".toast-container");

    const toast = document.createElement("div");
    toast.classList.add("toast", type);

    toast.innerHTML = `
    <div class="toast-content">
      <i class="icon fas fa-${getIcon(type)}"></i>
      <div class="message">
        <span class="text text-1">${capitalize(type)}</span>
        <span class="text text-2">${message}</span>
      </div>
    </div>
    <i class="fas fa-xmark close"></i>
    <div class="progress active"></div>
  `;

    toastContainer.appendChild(toast);
    let showToast = setTimeout(() => {
        void toast.offsetHeight;
        toast.classList.add("active");
    }, 1);

    const progress = toast.querySelector(".progress");
    const closeIcon = toast.querySelector(".close");

    // Auto-remove toast after 5s
    const timer1 = setTimeout(() => {
        toast.classList.remove("active");
    }, timeout);

    const timer2 = setTimeout(() => {
        progress.classList.remove("active");
        setTimeout(() => toast.remove(), 400);
    }, timeout + 300);

    // Manual close
    closeIcon.addEventListener("click", () => {
        toast.classList.remove("active");
        clearTimeout(timer1);
        clearTimeout(timer2);
        clearTimeout(showToast);
        setTimeout(() => toast.remove(), 400);
    });
}

function getIcon(type) {
    switch (type) {
        case "success":
            return "circle-check";
        case "error":
            return "circle-xmark";
        case "warning":
            return "triangle-exclamation";
        case "info":
            return "circle-info";
        default:
            return "check-circle-fill";
    }
}

function capitalize(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}

// Example Usage:
// showToast("Your changes have been saved!");

document.addEventListener("DOMContentLoaded", () => {
    let toastMessage = document.querySelectorAll("#toast-message")
    if (toastMessage.length < 1) {
        return;
    }
    toastMessage = toastMessage[0].innerText.trim()

    let toastType = document.querySelectorAll("#toast-type")
    if (toastType.length < 1) {
        showToast(toastMessage);
        return;
    }

    toastType = toastType[0].innerText.trim()
    showToast(toastMessage, toastType);
});
