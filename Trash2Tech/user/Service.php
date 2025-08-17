<?php
session_start();
include '../db_con.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/Small icon.webp">
    <link rel="stylesheet" href="css/service.css">
    <title>Service</title>
</head>

<body>
    <div class="wrapper">
        <?php include 'includes/navBar.php'; ?>

        <section class="hero">
            <h1>Effortless E-Waste Recycling Starts Here!</h1>
            <p>Responsible disposal of electronic waste made easy.</p>
            <a href="#services" class="btn">Explore Services</a>
        </section>

        <!-- Services Section -->
        <section id="services" class="services">
            <h2>Our Services</h2>
            <div class="service-container">
                <div class="service-box hidden">
                    <img src="images/1683510481newbanner1.webp" alt="Pickup">
                    <h3>E-Waste Collection</h3>
                    <p>Schedule a pickup, and we'll collect your old electronics responsibly.</p>
                </div>
                <div class="service-box hidden">
                    <img src="images/what-does-eco-friendly-mean-new-cover.jpg" alt="Recycle">
                    <h3>Eco-Friendly Recycling</h3>
                    <p>We ensure your e-waste is processed sustainably.</p>
                </div>
                <div class="service-box hidden">
                    <img src="images/img-bp-3-ways-eco-friendly-lifestyle-my-02-mb.webp" alt="Rewards">
                    <h3>Sustainable Impact</h3>
                    <p>Join us in building a greener future by recycling your e-waste responsibly.</p>
                </div>
            </div>
        </section>
    </div>

    <?php include 'includes/footer.php'; ?>
    <script src="js/service.js"></script>
</body>

</html>