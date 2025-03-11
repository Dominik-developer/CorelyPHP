
document.addEventListener("DOMContentLoaded", function () {
    const popup = document.getElementById("cookie-popup");
    const acceptButton = document.getElementById("accept-cookies");
    const rejectButton = document.getElementById("reject-cookies");

    const cookiesAccepted = document.cookie.includes("cookiesAccepted=true");
    const cookiesRejected = document.cookie.includes("cookiesAccepted=false");

    if (!cookiesAccepted && !cookiesRejected) {
        popup.style.display = "block";
    }

    function setCookie(name, value, days) {
        let expires = "";
        if (days) {
            const date = new Date();
            date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + value + expires + "; path=/public/"; //path may need to be changed for client
    }

    // Obsługa zgody na ciasteczka
    acceptButton.addEventListener("click", function () {
        setCookie("cookiesAccepted", "true", 365);
        popup.style.display = "none";
        location.reload();
    });

    // Obsługa odrzucenia ciasteczek
    rejectButton.addEventListener("click", function () {
        setCookie("cookiesAccepted", "false", 365);
        popup.style.display = "none";
        location.reload();
    });
});


