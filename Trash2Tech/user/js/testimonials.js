document.addEventListener("DOMContentLoaded", function () {
    var swiper = new Swiper(".testimonial-slider", {
        slidesPerView: 1, // Show one slide at a time
        spaceBetween: 20,
        loop: true, // Infinite loop
        autoplay: {
            delay: 3000, // Auto-slide every 3 seconds
            disableOnInteraction: false, // Keeps autoplay active after user interacts
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });
});