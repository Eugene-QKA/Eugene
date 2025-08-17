<?php
session_start();
include '../db_con.php';

header('Content-Type: application/json');

if (!isset($_SESSION['admin_id'])) {
    die(json_encode(['success' => false, 'message' => 'Unauthorized access']));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $username = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Validate role
    $allowedRoles = ['admin', 'collector', 'user'];
    if (!in_array($role, $allowedRoles)) {
        die(json_encode(['success' => false, 'message' => 'Invalid role']));
    }

    // Check email uniqueness
    $checkEmail = mysqli_query($conn, "SELECT id FROM users WHERE email = '$email' AND id != $id");
    if (mysqli_num_rows($checkEmail) > 0) {
        die(json_encode(['success' => false, 'message' => 'Email already exists']));
    }

    // Build update query
    $query = "UPDATE users SET 
             name = '$username', 
             email = '$email', 
             role = '$role'";
    
    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query .= ", password = '$hashedPassword'";
    }
    
    $query .= " WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . mysqli_error($conn)]);
    }
} else {
    die(json_encode(['success' => false, 'message' => 'Invalid request method']));
}
?>