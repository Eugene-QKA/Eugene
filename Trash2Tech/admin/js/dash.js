document.querySelector(".hamburger").addEventListener("click", function() {
    document.querySelector(".nav-links").classList.toggle("show");
});

// Icons for the map markers
const greenIcon = L.icon({
    iconUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.3/images/marker-icon.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.3/images/marker-shadow.png',
    shadowSize: [41, 41]
});

const lightIcon = L.icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-grey.png',
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

// Initialize map
const map = L.map('map').setView([3.139, 101.6869], 12);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
}).addTo(map);

// Function to update status via AJAX
function updateStatus(pickup_id, new_status) {
    fetch('dash.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `update_status=1&pickup_id=${pickup_id}&new_status=${new_status}`
    })
    .then(response => {
        if (response.ok) {
            // Update the status label in the table
            const statusCell = document.querySelector(`tr[data-pickup-id="${pickup_id}"] .status-label`);
            statusCell.textContent = new_status;
            statusCell.className = `status-label ${new_status.toLowerCase().replace(' ', '-')}`;
            
            // Update the counters
            updateCounters();
            
            // Update the marker on the map
            updateMarkerStatus(pickup_id, new_status);
        }
    })
    .catch(error => console.error('Error:', error));
}

// Function to update counters
function updateCounters() {
    fetch('dash.php')
    .then(response => response.text())
    .then(html => {
        // Create a temporary DOM element to parse the HTML
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        
        // Update the counters
        totalPickups.textContent = doc.getElementById('totalPickups').textContent;
        completedPickups.textContent = doc.getElementById('completedPickups').textContent;
        inProgressPickups.textContent = doc.getElementById('inProgressPickups').textContent;
        rejectedPickups.textContent = doc.getElementById('rejectedPickups').textContent;
    })
    .catch(error => console.error('Error:', error));
}

// Function to update marker status
function updateMarkerStatus(pickup_id, new_status) {
    // Find the marker associated with this pickup_id and update its icon
    // Note: You'll need to store markers in an object with pickup_id as keys
    if (window.markers && window.markers[pickup_id]) {
        let icon;
        if (new_status === "completed") icon = lightIcon;
        else if (new_status === "rejected") icon = redIcon;
        else if (new_status === "in progress") icon = orangeIcon;
        else icon = greenIcon;
        
        window.markers[pickup_id].setIcon(icon);
    }
}

// Initialize markers when the page loads
document.addEventListener('DOMContentLoaded', function() {
    // Get all pickup rows from the table
    const pickupRows = document.querySelectorAll('#pickupTable tr[data-pickup-id]');
    
    // Initialize markers object if it doesn't exist
    window.markers = window.markers || {};
    
    // Loop through each pickup row and add a marker to the map
    pickupRows.forEach(row => {
        const pickupId = row.getAttribute('data-pickup-id');
        const status = row.querySelector('.status-label').textContent.trim().toLowerCase();
        const address = row.querySelector('td:nth-child(2)').textContent;
        const date = row.querySelector('td:nth-child(3)').textContent;
        
        // Get lat and lon from data attributes (you'll need to add these to your PHP table rows)
        const lat = parseFloat(row.getAttribute('data-lat'));
        const lon = parseFloat(row.getAttribute('data-lon'));
        
        if (!isNaN(lat) && !isNaN(lon)) {
            // console.log(`Pickup ID: ${pickupId}, Status: "${status}"`);
            let icon;
            if (status === "completed") icon = lightIcon;
            else if (status === "rejected") icon = redIcon;
            else if (status === "in progress") icon = orangeIcon;
            else icon = greenIcon;
            
            // Create marker and add to map
            const marker = L.marker([lat, lon], { icon }).addTo(map);
            marker.bindPopup(
                `<strong>Pick-Up ID: ${pickupId}</strong><br><strong>${address}</strong><br>${date}<br>Status: ${status}`
            );
            
            // Store marker reference
            window.markers[pickupId] = marker;
        }
    });
});
