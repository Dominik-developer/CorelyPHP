
document.addEventListener("DOMContentLoaded", function() {
    const navBar = document.querySelector("nav"),
    menuBtns = document.querySelectorAll(".menu-icon"),
    overlay = document.querySelector(".overlay")
    optionBtns = document.querySelectorAll(".list")


    menuBtns.forEach(menuBtn => {
        menuBtn.addEventListener("click", () => {
            navBar.classList.toggle("open")
        })
    })

    optionBtns.forEach(optBtn => {
        optBtn.addEventListener("click", () => {
            navBar.classList.remove("open")
        })
    })

    overlay.addEventListener("click", () => {
        navBar.classList.remove("open");
    })
});