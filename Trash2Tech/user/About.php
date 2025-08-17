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
    <link rel="stylesheet" href="css/about.css">
    <title>About</title>
</head>
<body>
    <div class="wrapper">
        <?php include 'includes/navBar.php'; ?>
        <section class="hero-section">
            <div class="hero-content">
                <h1>Transforming E-Waste into a Greener Future!</h1>
                <p>Trash2Tech is dedicated to reducing e-waste by providing efficient, eco-friendly recycling solutions.</p>
                <a href="#mission" class="cta-btn">Learn More</a>
            </div>
        </section>
        <section class="mission-vision" id="mission">
            <div class="container">
                <div class="mission">
                    <img src="images/Mission.jpg" alt="Mission Icon" class="icon">
                    <h2>Our Mission</h2>
                    <p>At Trash2Tech, we aim to reduce e-waste by offering sustainable recycling solutions that make a difference.</p>
                </div>
                <div class="vision">
                    <img src="images/Vision.jpg" alt="Vision Icon" class="icon">
                    <h2>Our Vision</h2>
                    <p>We envision a future where technology waste is minimized, and resources are efficiently reused for a cleaner planet.</p>
                </div>
            </div>
        </section>

        <section class="our-story">
            <div class="story-header">
                <h2>Our Story</h2>
                <p>From an idea to a movement – how we started Trash2Tech.</p>
            </div>
        
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-icon">
                        <img src="images/CRC-HQ.jpg" alt="Founded">
                    </div>
                    <div class="timeline-content">
                        <h3>🚀 2023 - Founded</h3>
                        <p>Trash2Tech was born with a vision to reduce e-waste and promote sustainability.</p>
                    </div>
                </div>
        
                <div class="timeline-item">
                    <div class="timeline-icon">
                        <img src="images/what-we-do.png" alt="100 Devices Recycled">
                    </div>
                    <div class="timeline-content">
                        <h3>♻️ 2024 - First 100 Devices Recycled</h3>
                        <p>We successfully recycled 100 devices, preventing toxic waste from harming the environment.</p>
                    </div>
                </div>
        
                <div class="timeline-item">
                    <div class="timeline-icon">
                        <img src="images/63360206871.png" alt="Expansion">
                    </div>
                    <div class="timeline-content">
                        <h3>🌍 2025 - Expansion</h3>
                        <p>We expanded to multiple locations, reaching thousands of people and promoting e-waste awareness.</p>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="why-choose-us">
            <h2>🚀 Why Choose Us?</h2>
    
            <div class="card-container">
                <!-- Eco-Friendly -->
                <div class="card">
                    <i class="fas fa-recycle"></i>
                    <h3>🌿Eco-Friendly</h3>
                    <p>100% compliant recycling, reducing environmental impact.</p>
                </div>
    
                <!-- Secure Data Disposal -->
                <div class="card">
                    <i class="fas fa-shield-alt"></i>
                    <h3>🔐Secure Data Disposal</h3>
                    <p>Certified data wiping to protect your sensitive information.</p>
                </div>
    
                <!-- Hassle-Free Collection -->
                <div class="card">
                    <i class="fas fa-truck"></i>
                    <h3>🚛Hassle Collection</h3>
                    <p>We pick up e-waste from your location with Google Map.</p>
                </div>
    
                <!-- Certified Recycling -->
                <div class="card">
                    <i class="fas fa-certificate"></i>
                    <h3>♻️Certified Recycling</h3>
                    <p>We meet all environmental standards for safe disposal.</p>
                </div>
            </div>
        </section>
        <section class="team-section">
            <h2>Meet the Team</h2>
            <div class="team-container">
                <div class="team-member">
                    <img src="images/network.jpg" alt="Team Member 1">
                    <div class="info">
                        <h3>Eugene</h3>
                        <p class="role">Network Engineer</p>
                        <p class="fun-fact">"I can configure a router in under 5 minutes!"</p>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
        
                <div class="team-member">
                    <img src="images/cyber.jpeg" alt="Team Member 2">
                    <div class="info">
                        <h3>Wei Han</h3>
                        <p class="role">Cybersecurity Expert</p>
                        <p class="fun-fact">"I love breaking into my own systems for fun!"</p>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
        
                <div class="team-member">
                    <img src="images/Full stack.jpg" alt="Team Member 3">
                    <div class="info">
                        <h3>Jun Kit</h3>
                        <p class="role">Full Stack Developer</p>
                        <p class="fun-fact">"I once coded an entire website in one night!"</p>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="impact" class="impact-section">
            <h2>🌍 Our Impact</h2>
            <div class="impact-container">
                <div class="impact-box">
                    <h3 class="counter" data-target="500">0</h3>
                    <p>Devices Recycled</p>
                </div>
                <div class="impact-box">
                    <h3 class="counter" data-target="10000">0</h3>
                    <p>KG E-Waste Processed</p>
                </div>
                <div class="impact-box">
                    <h3 class="counter" data-target="20">0</h3>
                    <p>Collection Points</p>
                </div>
            </div>
        
            <!-- Optional Interactive Map (Placeholder) -->
            <div class="map-container">
                <iframe 
                    src="https://www.google.com/maps/d/u/0/embed?mid=1AJK4gnOCCkFQNcnAJEf__g6etjZepJU" 
                    width="100%" 
                    height="350" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>
        </section>
        
        <?php include 'includes/footer.php'; ?>

        <!-- Font Awesome Icons -->
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</div>

<script src="js/about.js"></script>
</body>
</html>