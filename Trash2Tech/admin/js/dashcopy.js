document.querySelector(".hamburger").addEventListener("click", function() {
    document.querySelector(".nav-links").classList.toggle("show");
});

// Sample Pickup Data
const pickups = [
    { id: "#589634", location: "123 Green St", date: "March 27, 2025", status: "In Progress", lat: 3.139, lon: 101.6869 },
    { id: "#853965", location: "456 Blue Ave", date: "March 27, 2025", status: "Rejected", lat: 3.145, lon: 101.692 },
    { id: "#982479", location: "789 Red Rd", date: "March 27, 2025", status: "Completed", lat: 3.152, lon: 101.679 },
    { id: "#958713", location: "101 Yellow Ln", date: "March 28, 2025", status: "Completed", lat: 3.158, lon: 101.680 }
];

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

// Reference to counters and table
const pickupTable = document.getElementById("pickupTable");
const totalPickups = document.getElementById("totalPickups");
const completedPickups = document.getElementById("completedPickups");
const inProgressPickups = document.getElementById("inProgressPickups");
const rejectedPickups = document.getElementById("rejectedPickups");

// Initial counts
let completed = pickups.filter(p => p.status === "Completed").length;
let inProgress = pickups.filter(p => p.status === "In Progress").length;
let rejected = pickups.filter(p => p.status === "Rejected").length;

totalPickups.textContent = pickups.length;
completedPickups.textContent = completed;
inProgressPickups.textContent = inProgress;
rejectedPickups.textContent = rejected;

// Create table rows and map markers
pickups.forEach((pickup, index) => {
    const row = document.createElement("tr");

    const idCell = document.createElement("td");
    idCell.textContent = pickup.id;

    const locationCell = document.createElement("td");
    locationCell.textContent = pickup.location;

    const dateCell = document.createElement("td");
    dateCell.textContent = pickup.date;

    const statusCell = document.createElement("td");
    statusCell.textContent = pickup.status;
    const statusClass = pickup.status.toLowerCase().replace(" ", "-");
    statusCell.className = `status-label ${statusClass}`;
    statusCell.id = `status-${index}`;

    const actionCell = document.createElement("td");

    // Create buttons
    const completeButton = document.createElement("button");
    completeButton.textContent = "Complete";
    completeButton.classList.add("complete-btn");
    completeButton.onclick = () => updateStatus(index, "Completed");

    const rejectButton = document.createElement("button");
    rejectButton.textContent = "Reject";
    rejectButton.classList.add("reject-btn");
    rejectButton.onclick = () => updateStatus(index, "Rejected");

    const inProgressButton = document.createElement("button");
    inProgressButton.textContent = "In Progress";
    inProgressButton.classList.add("in-progress-btn");
    inProgressButton.onclick = () => updateStatus(index, "In Progress");

    actionCell.appendChild(completeButton);
    actionCell.appendChild(rejectButton);
    actionCell.appendChild(inProgressButton);

    row.appendChild(idCell);
    row.appendChild(locationCell);
    row.appendChild(dateCell);
    row.appendChild(statusCell);
    row.appendChild(actionCell);

    pickupTable.appendChild(row);

    // Marker for map
    let icon;
    if (pickup.status === "Completed") icon = lightIcon;
    else if (pickup.status === "Rejected") icon = redIcon;
    else if (pickup.status === "In Progress") icon = orangeIcon;
    else icon = greenIcon;

    const marker = L.marker([pickup.lat, pickup.lon], { icon }).addTo(map);
    marker.bindPopup(
        `<strong>Pick-Up ID: ${pickup.id}</strong><br><strong>${pickup.location}</strong><br>${pickup.date}<br>Status: ${pickup.status}`
    );

    pickup.marker = marker; // store marker
});

function updateStatus(index, newStatus) {
    const pickup = pickups[index];
    const statusCell = document.getElementById(`status-${index}`);

    // Decrease old status count
    if (pickup.status === "Completed") completed--;
    else if (pickup.status === "Rejected") rejected--;
    else if (pickup.status === "In Progress") inProgress--;

    // Set new status
    pickup.status = newStatus;
    statusCell.textContent = newStatus;
    statusCell.className = `status-label ${newStatus.toLowerCase().replace(" ", "-")}`;

    // Increase new status count
    if (newStatus === "Completed") completed++;
    else if (newStatus === "Rejected") rejected++;
    else if (newStatus === "In Progress") inProgress++;

    // Update dashboard counters
    completedPickups.textContent = completed;
    rejectedPickups.textContent = rejected;
    inProgressPickups.textContent = inProgress;

    // Update marker
    updateMarkerStatus(index);
}

function updateMarkerStatus(index) {
    const pickup = pickups[index];
    let icon;
    if (pickup.status === "Completed") icon = lightIcon;
    else if (pickup.status === "Rejected") icon = redIcon;
    else if (pickup.status === "In Progress") icon = orangeIcon;
    else icon = greenIcon;

    pickup.marker.setIcon(icon);
}
