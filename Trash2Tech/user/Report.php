<?php
session_start();
include '../db_con.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>
        alert('Please login first');
        window.location.href='index.php';
    </script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/Small icon.webp">
    <link rel="stylesheet" href="css/Report.css">
    <title>Report Status</title>
</head>

<body>
    <?php include 'includes/navBar.php'; ?>
    <div class="wrapper">
        <div class="content">
            <div class="container">
                <h2>Report Status</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Request ID</th>
                            <th>Date & Time</th>
                            <th>Pickup Address</th>
                            <th>Status</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $user_id = $_SESSION['user_id'];

                        $sql = "SELECT * FROM pickup WHERE user_id = ? ORDER BY date DESC";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $user_id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        $counter = 1;

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $formattedDate = date("F j, Y - g:i A", strtotime($row['date']));

                                echo "<tr>
                                        <td>#{$row['id']}</td>
                                        <td>{$formattedDate}</td>
                                        <td>{$row['address']}</td>
                                        <td><span class='status " . strtolower(str_replace(' ', '-', $row['status'])) . "'>" . ucfirst($row['status']) . "</span></td>
                                        <td><button class='expand-btn' onclick='toggleDetails({$counter})'>🔽</button></td>
                                    </tr>
                                    <tr class='details' id='details-{$counter}'>
                                        <td colspan='5'>
                                            <p><strong>Category:</strong> " . ucfirst($row['waste_type']) . "</p>
                                        </td>
                                    </tr>";

                                $counter++;
                            }
                        } else {
                            echo "<tr><td colspan='5'>No pickup requests found.</td></tr>";
                        }

                        $stmt->close();
                        ?>
                </table>
            </div>
        </div>
        <?php include 'includes/footer.php'; ?>
    </div>
    <script src="js/Report.js"></script>
</body>

</html>