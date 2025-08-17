<?php
session_start();
include '../db_con.php';

if (isset($_POST['submit']) && isset($_SESSION['user_id'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $contact = mysqli_real_escape_string($conn, $_POST['phone']);
    $waste_type = mysqli_real_escape_string($conn, $_POST['ewaste']);
    $pickup_date = mysqli_real_escape_string($conn, $_POST['date']);
    $lat = mysqli_real_escape_string($conn, $_POST['lat']);
    $lon = mysqli_real_escape_string($conn, $_POST['lon']);
    $status = 'pending';
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO pickup (name, address, contact, waste_type, date, lat, lon, status, user_id)
            VALUES ('$name', '$address', '$contact', '$waste_type', '$pickup_date', '$lat', '$lon', '$status', '$user_id')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
            alert('Pickup request submitted successfully!');
            localStorage.clear();
            window.location.href='Pick-up.php';
        </script>";
    } else {
        echo "<script>alert('Failed to submit pickup request.');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/Small icon.webp">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="css/Pick-up.css">
    <title>Pick up</title>
</head>

<body>
    <?php include 'includes/navBar.php'; ?>
    <div class="hero-section">
        <div class="hero-content">
            <h1>Trash2Tech<br>Pickup Services</h1>
            <p>Schedule your pickup today and let us handle your electronic waste the eco-friendly way.</p>
            <a href="#pickup-form" class="pickup-button">Schedule a Pickup <span>→</span></a>
        </div>
    </div>

    <section id="how-it-works" class="how-it-works">
        <h2>How It Works</h2>
        <div class="process-container">
            <div class="process-step">
                <img src="images/woman-picking-up-trash-in-a-parking-lot-for-her-litter-pick-up-business.png"
                    alt="Request Pickup Icon">
                <h3>Request a Pickup</h3>
                <p>Fill in a simple form to schedule your e-waste pickup.</p>
            </div>
            <div class="process-step">
                <img src="images/istockphoto-1410016214-612x612.jpg" alt="We Collect Icon">
                <h3>We Collect</h3>
                <p>Our team will arrive at your location and pick up the e-waste.</p>
            </div>
            <div class="process-step">
                <img src="images/Waste 4 Ways Graphic-1.webp" alt="Eco-Friendly Disposal Icon">
                <h3>Eco-Friendly Disposal</h3>
                <p>We ensure responsible recycling and disposal of your e-waste.</p>
            </div>
        </div>
    </section>
    <div class="container" id="pickup-form">
        <h2>Pickup Request Form</h2>
        <form method="POST" onsubmit="return checkLogin();" action="">
            <label>Name 📛</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" required>

            <label>Address 📍</label>
            <input id="autocomplete" type="text" name="address" placeholder="Enter your address" required>
            <div id="map"></div>
            <input type="hidden" id="lat" name="lat">
            <input type="hidden" id="lon" name="lon">

            <label>Contact Info ☎️</label>
            <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>

            <label>Type of E-Waste ♻️</label>
            <select id="ewaste" name="ewaste">
                <option value="small electronics">Small Electronics</option>
                <option value="large appliances">Large Appliances</option>
                <option value="batteries">Batteries</option>
                <option value="other">Other</option>
            </select>

            <label>Preferred Pickup Date 🗓️</label>
            <input type="datetime-local" id="date" name="date" required>

            <button type="submit" name="submit">Request Pickup</button>
        </form>
    </div>

    <div class="testimonial-section">
        <h2>What Our Users Say 💬</h2>
        <div class="testimonial-container">
            <div class="testimonial-slider">
                <div class="testimonial-card">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User 1">
                    <p>"Trash2Tech made recycling so easy! Highly recommended. ⭐⭐⭐⭐⭐"</p>
                    <h4>- John Doe</h4>
                </div>
                <div class="testimonial-card">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User 2">
                    <p>"Fast pickup service and friendly staff. Great initiative! ♻️"</p>
                    <h4>- Jane Smith</h4>
                </div>
                <div class="testimonial-card">
                    <img src="https://randomuser.me/api/portraits/men/55.jpg" alt="User 3">
                    <p>"I love how simple and effective this system is. 🔥"</p>
                    <h4>- Alex Lee</h4>
                </div>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="js/Pick-up.js"></script>
    <script>
        function checkLogin() {
            <?php if (!isset($_SESSION['user_id'])): ?>
                alert("Please login to fill the form");

                // Save form data to localStorage
                localStorage.setItem("pickup_name", document.getElementById("name").value);
                localStorage.setItem("pickup_address", document.getElementById("autocomplete").value);
                localStorage.setItem("pickup_phone", document.getElementById("phone").value);
                localStorage.setItem("pickup_ewaste", document.getElementById("ewaste").value);
                localStorage.setItem("pickup_date", document.getElementById("date").value);
                localStorage.setItem("pickup_lat", document.getElementById("lat").value);
                localStorage.setItem("pickup_lon", document.getElementById("lon").value);

                // Redirect to login page
                window.location.href = "login.php?redirect=Pick-up.php#pickup-form";
                return false; // stop form submission
            <?php else: ?>
                return true; // proceed with form submission
            <?php endif; ?>
        }
        window.addEventListener("load", function () {
            if (localStorage.getItem("pickup_name")) {
                document.getElementById("name").value = localStorage.getItem("pickup_name");
                document.getElementById("autocomplete").value = localStorage.getItem("pickup_address");
                document.getElementById("phone").value = localStorage.getItem("pickup_phone");
                document.getElementById("ewaste").value = localStorage.getItem("pickup_ewaste");
                document.getElementById("date").value = localStorage.getItem("pickup_date");
                document.getElementById("lat").value = localStorage.getItem("pickup_lat");
                document.getElementById("lon").value = localStorage.getItem("pickup_lon");
            }
        });
    </script>
</body>

</html>