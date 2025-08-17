<?php
session_start();
include '../db_con.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/Small icon.webp ">
    <link rel="stylesheet" href="css/Contact.css">
    <title>Contact</title>
</head>
<body>
    <div class="wrapper">
    <?php include 'includes/navBar.php'; ?>
        
        <section class="contact">
            <div class="contact-container">
                <h2>Contact Us</h2>
                <p>Have any questions? Feel free to reach out!</p>
    
                <div class="contact-info">
                    <div class="info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        Taman Eko Rimba Kanching, Kilometer 17, off Jalan Rawang, 48000, Selangor, Malaysia
                    </div>
                    <div class="info-item">
                        <i class="fas fa-envelope"></i>
                        support@trash2tech.com
                    </div>
                    <div class="info-item">
                        <i class="fas fa-phone-alt"></i>
                        +60 1110632063
                    </div>
                </div>
            </section>
        </div>

        <?php include 'includes/footer.php'; ?>
        
       
    </div>    
    <script src="js/Contact.js" defer></script>

</body>
</html>