<?php
session_start();
include '../db_con.php';

if (!isset($_SESSION['collector_id'])) {
    header('Location: login.php');
    exit();
}

// Handle status updates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $pickup_id = mysqli_real_escape_string($conn, $_POST['pickup_id']);
    $new_status = mysqli_real_escape_string($conn, $_POST['new_status']);

    $sql = "UPDATE pickup SET status = '$new_status' WHERE id = '$pickup_id'";
    mysqli_query($conn, $sql);
    exit();
}

// Fetch pickup data
$sql = "SELECT * FROM pickup WHERE status NOT IN ('completed', 'rejected') ORDER BY date DESC";
$result = mysqli_query($conn, $sql);
$pickups = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/Small icon.webp">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="css/Assign pick.css">
    <title>Pick up</title>
</head>

<body>
    <?php include 'includes/navBar.php'; ?>
    <h1 style="text-align: center;">Trash2Tech Waste Collection</h1>

    <div class="pickup-container">
        <h2>Scheduled Pickups</h2>
        <?php foreach ($pickups as $pickup): ?>
            <div class="pickup-card" data-pickup-id="<?php echo $pickup['id']; ?>" data-lat="<?php echo $pickup['lat']; ?>"
                data-lon="<?php echo $pickup['lon']; ?>">
                <p><strong>Pickup ID:</strong> #<?php echo htmlspecialchars($pickup['id']); ?></p>
                <p><strong>Location:</strong> <?php echo htmlspecialchars($pickup['address']); ?></p>
                <p><strong>Date:</strong> <?php echo date('F j, Y', strtotime($pickup['date'])); ?></p>
                <p><strong>Time:</strong> <?php echo date('g:i A', strtotime($pickup['date'])); ?></p>
                <p><strong>Status:</strong> <span
                        class="status-label"><?php echo htmlspecialchars(ucfirst($pickup['status'])); ?></span></p>
                <div class="top-buttons">
                    <button class="accept-btn" onclick="updateStatus('<?php echo $pickup['id']; ?>', 'in progress')">In
                        Progress</button>
                    <button class="complete-btn"
                        onclick="updateStatus('<?php echo $pickup['id']; ?>', 'completed')">Complete</button>
                    <button class="reject-btn"
                        onclick="updateStatus('<?php echo $pickup['id']; ?>', 'rejected')">Reject</button>
                </div>
                <div class="bottom-button">
                    <button class="locate-btn" onclick="locatePickup('<?php echo $pickup['id']; ?>')">Show Location</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Map Container -->
    <div id="map"></div>
    <?php include 'includes/footer.php'; ?>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="js/Assign pick.js"></script>
</body>

</html>