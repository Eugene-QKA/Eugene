document.querySelector(".hamburger").addEventListener("click", function() {
    document.querySelector(".nav-links").classList.toggle("show");
});

document.addEventListener("DOMContentLoaded", function () {
    const counters = document.querySelectorAll(".counter");

    counters.forEach(counter => {
        counter.innerText = "0";

        const updateCounter = () => {
            const target = +counter.getAttribute("data-target");
            const count = +counter.innerText;

            const increment = target / 100;

            if (count < target) {
                counter.innerText = Math.ceil(count + increment);
                setTimeout(updateCounter, 15);
            } else {
                counter.innerText = target.toLocaleString(); /* Formats numbers properly */
            }
        };

        updateCounter();
    });
});


document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("pickupTrash").addEventListener("click", function (event) {
        let isLoggedIn = false; // Change this based on your authentication system

        if (!isLoggedIn) {
            event.preventDefault(); // Prevent default link behavior
            window.location.href = "login.html"; // Redirect to login page
        } else {
            window.location.href = "pickup.html"; // If logged in, go to pickup page
        }
    });
});


