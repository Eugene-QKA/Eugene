document.querySelector(".hamburger").addEventListener("click", function () {
    document.querySelector(".nav-links").classList.toggle("show");
});

// Marker icons
const greenIcon = L.icon({
    iconUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.3/images/marker-icon.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.3/images/marker-shadow.png',
    shadowSize: [41, 41]
});

const lightIcon = L.icon({
    iconUrl: 'https://cdn-icons-png.flaticon.com/512/684/684908.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34]
});

const redIcon = L.icon({
    iconUrl: 'https://cdn-icons-png.flaticon.com/512/463/463612.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34]
});

const orangeIcon = L.icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-orange.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34]
});

// Initialize the map
const map = L.map('map').setView([3.1390, 101.6869], 13);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);

// Store markers globally
window.markers = window.markers || {};

// Initialize markers for each pickup
document.querySelectorAll(".pickup-card").forEach(card => {
    const pickupId = card.getAttribute("data-pickup-id");
    const lat = parseFloat(card.getAttribute("data-lat"));
    const lon = parseFloat(card.getAttribute("data-lon"));
    const status = card.querySelector(".status-label").textContent.trim().toLowerCase();
    const address = card.querySelector("p:nth-child(2)").textContent;
    const date = card.querySelector("p:nth-child(3)").textContent;

    if (!isNaN(lat) && !isNaN(lon)) {
        let icon;
        if (status === "completed") icon = lightIcon;
        else if (status === "rejected") icon = redIcon;
        else if (status === "in progress") icon = orangeIcon;
        else icon = greenIcon;

        const marker = L.marker([lat, lon], { icon }).addTo(map);
        marker.bindPopup(
            `<strong>Pick-Up ID: ${pickupId}</strong><br><strong>${address}</strong><br>${date}<br>Status: ${status}`
        );

        window.markers[pickupId] = marker;
    }
});

// Function to update status via AJAX
function updateStatus(pickup_id, new_status) {
    fetch('Assign pick.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `update_status=1&pickup_id=${pickup_id}&new_status=${new_status}`
    })
        .then(response => {
            if (response.ok) {
                const card = document.querySelector(`.pickup-card[data-pickup-id="${pickup_id}"]`);
                const statusLabel = card.querySelector(".status-label");
                statusLabel.textContent = new_status.charAt(0).toUpperCase() + new_status.slice(1);
                statusLabel.className = `status-label ${new_status.toLowerCase().replace(' ', '-')}`;

                updateMarkerStatus(pickup_id, new_status);
            }
        })
        .catch(error => console.error('Error:', error));
}

// Function to update marker icon based on new status
function updateMarkerStatus(pickup_id, new_status) {
    if (window.markers && window.markers[pickup_id]) {
        let icon;
        if (new_status === "completed") icon = lightIcon;
        else if (new_status === "rejected") icon = redIcon;
        else if (new_status === "in progress") icon = orangeIcon;
        else icon = greenIcon;

        window.markers[pickup_id].setIcon(icon);
    }
}

function locatePickup(pickup_id) {
    if (window.markers && window.markers[pickup_id]) {
        const marker = window.markers[pickup_id];
        map.setView(marker.getLatLng(), 15);
        marker.openPopup();
    }
}