<?php
session_start();
include '../db_con.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Waste Homepage</title>
    <link rel="icon" href="images/Small icon.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="css/homepage.css">
</head>

<body>
    <div class="wrapper">
        <?php include 'includes/navBar.php'; ?>
        <div class="hero-section">
            <div class="hero-content">
                <h1>Welcome to Trash2Tech Management</h1>
                <p>Trash2Tech Management is dedicated to transforming e-waste into sustainable solutions through secure
                    disposal, certified recycling, and hassle-free collection—empowering a greener future, one device at
                    a time.</p>
            </div>
        </div>
        <section class="features">
            <h2>Key Features</h2>
            <div class="features-container">
                <!-- E-Waste Collection -->
                <div class="feature">
                    <img src="images/istockphoto-1032912050-612x612.jpg" alt="E-Waste Collection">
                    <h3>E-Waste Collection</h3>
                    <p>Free or paid pickup service for your old electronic devices.</p>
                </div>

                <!-- Secure Data Destruction -->
                <div class="feature">
                    <img src="images/images (1).jpeg" alt="Secure Data Destruction">
                    <h3>Secure Data Destruction</h3>
                    <p>Safe disposal of devices containing sensitive data.</p>
                </div>

                <!-- Recycling Process -->
                <div class="feature">
                    <img src="images/garbage-truck-pictures-sydx7bxcv3fjcxii.jpg" alt="Recycling Process">
                    <h3>Recycling Process</h3>
                    <p>We ensure materials are repurposed for sustainability.</p>
                </div>
            </div>
        </section>
        <section class="impact-section">
            <h2>Our E-Waste Impact</h2>
            <div class="stats-container">
                <div class="stat-item">
                    <h3>♻ <span class="counter" data-target="5000">0</span>+</h3>
                    <p>Devices Recycled</p>
                </div>
                <div class="stat-item">
                    <h3>🔋 <span class="counter" data-target="10000">0</span>+</h3>
                    <p>Batteries Disposed Safely</p>
                </div>
            </div>
        </section>
        <section class="testimonial-section">
            <h2>What Our Users Say</h2>

            <div class="swiper testimonial-slider">
                <div class="swiper-wrapper">
                    <!-- Testimonial 1 -->
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <p>The e-waste recycling process was super easy and efficient!</p>
                            <h4>- Wei Han</h4>
                        </div>
                    </div>

                    <!-- Testimonial 2 -->
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <p>Great service! I can now safely dispose of my old electronics!</p>
                            <h4>- Jun Kit</h4>
                        </div>
                    </div>

                    <!-- Testimonial 3 -->
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <p>Highly recommend! They make e-waste disposal so convenient!</p>
                            <h4>- Eugene Chia</h4>
                        </div>
                    </div>
                </div>

                <!-- Pagination Dots -->
                <div class="swiper-pagination"></div>
            </div>
        </section>

        <?php include 'includes/footer.php'; ?>

        <!-- Then load your homepage.js file -->
        <script src="js/homepage.js"></script>
        <!-- Swiper.js JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
        <script src="js/testimonials.js"></script>
    </div>
</body>

</html>