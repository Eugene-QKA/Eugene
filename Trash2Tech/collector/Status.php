<?php
session_start();
include '../db_con.php';

if (!isset($_SESSION['collector_id'])) {
    header('Location: login.php');
    exit();
}

// Fetch pickup data
$sql = "SELECT * FROM pickup ORDER BY date DESC";
$result = mysqli_query($conn, $sql);
$pickups = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/Small icon.webp">
    <link rel="stylesheet" href="css/Status.css">
    <title>Report Status</title>
</head>

<body>
    <?php include 'includes/navBar.php'; ?>
    <div class="status-container">
        <h2>📦 Update Pickup Status</h2>

        <?php foreach ($pickups as $pickup): ?>
            <div class="status-card">
                <div class="card-header">
                    <p><strong>📍 Location: </strong><?php echo htmlspecialchars($pickup['address']); ?></p>
                    <span
                        class="status-label <?php echo strtolower(str_replace(' ', '-', $pickup['status'])); ?>"><?php echo htmlspecialchars(ucfirst($pickup['status'])); ?></span>
                </div>
                <p><strong>📅 Date:</strong> <?php echo date('F j, Y', strtotime($pickup['date'])); ?></p>
                <p><strong>⏰ Time:</strong> <?php echo date('g:i A', strtotime($pickup['date'])); ?></p>
            </div>

        <?php endforeach; ?>

        <?php if (empty($pickups)): ?>
            <div class="no-pickups">
                <p>No pending pickups found.</p>
            </div>
        <?php endif; ?>
    </div>

    <?php include 'includes/footer.php'; ?>
    <script src="js/Status.js"></script>
</body>

</html>