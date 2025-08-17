<?php
session_start();
include '../db_con.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password, role) 
                VALUES ('$username', '$email', '$password', '$role')";
    mysqli_query($conn, $sql);
}

// Delete user
if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM users WHERE id = $id";
    mysqli_query($conn, $sql);
    header("Location: manage.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/Small icon.png" type="image/png">
    <link rel="stylesheet" href="css/manage.css">
    <title>Manage User</title>
</head>

<body>
    <?php include 'includes/navBar.php'; ?>
    <div class="container">
        <h1>Manage Users</h1>

        <!-- Add User Form -->
        <div class="add-user-form">
            <h2>Add New User</h2>
            <form method="POST" action="manage.php">
                <input type="text" id="username" name="username" placeholder="Enter Username" required>
                <input type="email" id="email" name="email" placeholder="Enter Email" required>

                <!-- Password Input -->
                <div class="password-container">
                    <input type="password" id="password" name="password" placeholder="Enter Password" required>
                    <button type="button" onclick="togglePassword()">👁️</button>
                </div>

                <label for="role">Role:</label>
                <select id="role" name="role">
                    <option value="admin">admin</option>
                    <option value="collector">collector</option>
                    <option value="user">user</option>
                </select>

                <button type="submit">Add User</button>
            </form>
        </div>

        <!-- Users Table -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM users";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "
                    <tr data-user-id='{$row['id']}'>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['role']}</td>
                        <td>
                            <button class='edit-btn' onclick='editUser({$row['id']})'>Edit</button>
                            <a href='manage.php?action=delete&id={$row['id']}' class='delete-btn'
                               onclick='return confirm(\"Are you sure?\")'>Delete</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php include 'includes/footer.php'; ?>
    <script src="js/manage.js"></script>
</body>

</html>