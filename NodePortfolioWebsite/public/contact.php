<?php
$host = 'localhost';
$user = 'root';         // WAMP default user
$password = '';         // WAMP default password
$database = 'eugene_db'; // your DB name

// Connect to MySQL
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get form data safely
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';

// Prepare SQL insert
$stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $message);

// Execute and redirect
if ($stmt->execute()) {
  header("Location: thanks.html");
  exit();
} else {
  echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
