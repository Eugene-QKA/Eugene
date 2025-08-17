document.querySelector(".hamburger").addEventListener("click", function() {
    document.querySelector(".nav-links").classList.toggle("show");
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

document.addEventListener("DOMContentLoaded", function () {
    const timelineItems = document.querySelectorAll(".timeline-item");

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("show");
                }
            });
        },
        { threshold: 0.5 }
    );

    timelineItems.forEach((item) => {
        observer.observe(item);
    });
});

document.addEventListener("DOMContentLoaded", () => {
    const counters = document.querySelectorAll(".counter");

    const startCounter = (counter) => {
        const target = +counter.getAttribute("data-target");
        const speed = target / 100;

        let count = 0;
        const updateCount = () => {
            if (count < target) {
                count += speed;
                counter.innerText = Math.floor(count);
                requestAnimationFrame(updateCount);
            } else {
                counter.innerText = target;
            }
        };

        updateCount();
    };

    // Scroll Trigger
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                startCounter(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    counters.forEach((counter) => observer.observe(counter));
});
