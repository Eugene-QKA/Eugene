document.querySelector(".hamburger").addEventListener("click", function() {
    document.querySelector(".nav-links").classList.toggle("show");
});

// Initialize the map
var map = L.map('map').setView([3.1390, 101.6869], 12); // Default to KL

// Load and display OpenStreetMap tiles
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);

// Add a default marker
var marker = L.marker([3.1390, 101.6869]).addTo(map)
    .bindPopup("Your Location").openPopup();

// Create hidden input fields for lat/lon if they don't exist
if (!document.getElementById('lat')) {
    const latInput = document.createElement('input');
    latInput.type = 'hidden';
    latInput.id = 'lat';
    latInput.name = 'lat';
    latInput.value = '3.1390';
    document.querySelector('form').appendChild(latInput);
}

if (!document.getElementById('lon')) {
    const lonInput = document.createElement('input');
    lonInput.type = 'hidden';
    lonInput.id = 'lon';
    lonInput.name = 'lon';
    lonInput.value = '101.6869';
    document.querySelector('form').appendChild(lonInput);
}

// Update coordinates when marker is moved
marker.on('dragend', function(e) {
    const position = marker.getLatLng();
    document.getElementById('lat').value = position.lat;
    document.getElementById('lon').value = position.lng;
});

// Make marker draggable
marker.dragging.enable();

// Autocomplete Address Search (Using Nominatim API)
document.getElementById("autocomplete").addEventListener("change", function () {
    var address = this.value;
    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${address}`)
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {
                var lat = data[0].lat;
                var lon = data[0].lon;

                // Move map to selected location
                map.setView([lat, lon], 14);

                // Move marker
                marker.setLatLng([lat, lon])
                    .bindPopup(`Selected Location: ${address}`).openPopup();

                // Update hidden fields
                document.getElementById('lat').value = lat;
                document.getElementById('lon').value = lon;
            } else {
                alert("Address not found!");
            }
        });
});

let currentIndex = 0;

        function autoSlide() {
            const slider = document.querySelector(".testimonial-slider");
            const slides = document.querySelectorAll(".testimonial-card");
            const totalSlides = slides.length;

            currentIndex++;

            if (currentIndex >= totalSlides) {
                currentIndex = 0;
            }

            const offset = -currentIndex * 100;
            slider.style.transform = `translateX(${offset}%)`;
        }

        window.onload = function () {
            document.querySelector(".testimonial-card").style.transform = "scale(1.01)";
            setTimeout(() => {
                document.querySelector(".testimonial-card").style.transform = "scale(1)";
            }, 200);

            setTimeout(() => {
                setInterval(autoSlide, 4000); 
            }, 1000);
        };