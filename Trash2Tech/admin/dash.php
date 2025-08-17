<?php
session_start();
include '../db_con.php';

if (!isset($_SESSION['admin_id'])) {
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
$pickups = [];
$sql = "SELECT * FROM pickup ORDER BY date DESC";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $pickups[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="icon" href="images/Small icon.png" type="image/png">
    <link rel="stylesheet" href="css/dash.css">
    <title>DashBoard</title>
</head>

<body>
    <?php include 'includes/navBar.php'; ?>
    <div class="dashboard-container">
        <main class="dashboard-content">
            <h1>Welcome, Admin</h1>

            <!-- Overview Panel -->
            <section class="overview">
                <?php
                $counts = [
                    'total' => count($pickups),
                    'completed' => 0,
                    'in_progress' => 0,
                    'rejected' => 0
                ];

                foreach ($pickups as $pickup) {
                    if ($pickup['status'] === 'completed')
                        $counts['completed']++;
                    elseif ($pickup['status'] === 'in progress')
                        $counts['in_progress']++;
                    elseif ($pickup['status'] === 'rejected')
                        $counts['rejected']++;
                }
                ?>
                <div class="card total-pickups">
                    <h3>Total Pickups</h3>
                    <p id="totalPickups"><?php echo $counts['total']; ?></p> <!-- This will be dynamically updated -->
                </div>
                <div class="card completed-pickups">
                    <h3>Completed</h3>
                    <p id="completedPickups"><?php echo $counts['completed']; ?></p>
                    <!-- This will be dynamically updated -->
                </div>
                <div class="card pending-pickups">
                    <h3>In Progress</h3>
                    <p id="inProgressPickups"><?php echo $counts['in_progress']; ?></p> <!-- Changed ID -->
                </div>
                <div class="card rejected-pickups"> <!-- New section for rejected pickups -->
                    <h3>Rejected</h3>
                    <p id="rejectedPickups"><?php echo $counts['rejected']; ?></p>
                    <!-- Dynamically updated rejected count -->
                </div>

            </section>

            <!-- Manage Pickups -->
            <section class="manage-pickups">
                <h2>Manage Pickups</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Pick-Up ID</th>
                            <th>Location</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="pickupTable">
                        <?php foreach ($pickups as $index => $pickup): ?>
                            <tr data-pickup-id="<?php echo htmlspecialchars($pickup['id']); ?>"
                                data-lat="<?php echo htmlspecialchars($pickup['lat']); ?>"
                                data-lon="<?php echo htmlspecialchars($pickup['lon']); ?>">
                                <td><?php echo htmlspecialchars($pickup['id']); ?></td>
                                <td><?php echo htmlspecialchars($pickup['address']); ?></td>
                                <td><?php echo date('F j, Y', strtotime($pickup['date'])); ?></td>
                                <td
                                    class="status-label <?php echo strtolower(str_replace(' ', '-', $pickup['status'])); ?>">
                                    <?php echo htmlspecialchars($pickup['status']); ?>
                                </td>
                                <td>
                                    <button class="complete-btn"
                                        onclick="updateStatus('<?php echo $pickup['id']; ?>', 'completed')">Complete</button>
                                    <button class="reject-btn"
                                        onclick="updateStatus('<?php echo $pickup['id']; ?>', 'rejected')">Reject</button>
                                    <button class="in-progress-btn"
                                        onclick="updateStatus('<?php echo $pickup['id']; ?>', 'in progress')">In
                                        Progress</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>

            <!-- Live Map View -->
            <section class="live-map">
                <h2>Live Map View</h2>
                <div id="map"></div>
            </section>
        </main>
    </div>
    <?php include 'includes/footer.php'; ?>
    </footer>
    <script src="js/dash.js"></script>
</body>

</html>