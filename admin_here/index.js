
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

document.addEventListener("DOMContentLoaded", function() {

       // Funkcja do obsługi kliknięcia w przycisk
       function handleButtonClick(sectionId) {
        // Pobierz wszystkie sekcje
        const sections = document.querySelectorAll('.section');

        // Ukryj wszystkie sekcje
        sections.forEach(section => section.classList.remove('visible'));

        // Pokaż wybraną sekcję
        document.getElementById(sectionId).classList.add('visible');
 
    }

    // Dodaj event listenery do przycisków
    document.getElementById("allBtn").addEventListener('click', function() {
        handleButtonClick('allSection');
    });
    document.getElementById("section1Btn").addEventListener('click', function() {
        handleButtonClick('section1');
    });
    document.getElementById("section2Btn").addEventListener('click', function() {
        handleButtonClick('section2');
    });
    document.getElementById("section3Btn").addEventListener('click', function() {
        handleButtonClick('section3');
    });
    document.getElementById("section4Btn").addEventListener('click', function() {
        handleButtonClick('section4');
    });

});

/*
document.addEventListener("DOMContentLoaded", function() {
    const smallMenuBtn = document.querySelectorAll(""),

    smallMenuBtns.forEach(smallMenuBtn => {
        smallMenuBtn.addEventListener("click", () => {
            .classList.toggle("visible")
        })
    })

})

*/

/*mesage handler*/ 
document.addEventListener("DOMContentLoaded", function() {

    // Zamknij popout po kliknięciu w X
    document.getElementById('close-btn')?.addEventListener('click', function() {
        document.getElementById('overlay').classList.add('hidden');
    });

    // Zamknij popout po kliknięciu poza nim
    document.getElementById('overlay')?.addEventListener('click', function(event) {
        if (event.target.id === 'overlay') {
            document.getElementById('overlay').classList.add('hidden');
        }
    });
});