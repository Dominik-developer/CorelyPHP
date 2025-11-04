
// -- SIDEBAR --
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


/*mesage handler*/ 
document.addEventListener("DOMContentLoaded", function() {

    // close poout by X 
    document.getElementById('close-btn')?.addEventListener('click', function() {
        document.getElementById('overlay').classList.add('hidden');
    });

    // close popout area around popout 
    document.getElementById('overlay')?.addEventListener('click', function(event) {
        if (event.target.id === 'overlay') {
            document.getElementById('overlay').classList.add('hidden');
        }
    });
});