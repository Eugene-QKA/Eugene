<?php
include '../db_con.php';

// Form submission check
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = trim($_POST['firstname']);
  $email = trim($_POST['email']);
  $password = $_POST['password'];
  $repeat_password = $_POST['repeat-password'];

  // Check if email already exists
  $check_sql = "SELECT * FROM users WHERE email = ?";
  $stmt = $conn->prepare($check_sql);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    die("Email already registered.");
  }

  // Hash the password
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // Insert into database
  $sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'user')";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sss", $name, $email, $hashed_password);

  if ($stmt->execute()) {
    echo "<script>alert('Signup successful. Please login.'); window.location='login.php';</script>";
  } else {
    echo "Error: " . $conn->error;
  }

  $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signup</title>
  <link rel="stylesheet" href="css/style.css">
  <script type="text/javascript" src="js/validation.js" defer></script>
  <link rel="icon" type="image/png" href="images/Small icon.webp">
</head>
<body>
  <div class="wrapper">
    <div class="logo">
      <img src="images/Small Logo.jpg" alt="E-Waste Logo"> <!-- Make sure to replace with your logo -->
  </div>
    <h1>Signup</h1>
    <p id="error-message"></p>
    <form id="form" action="signup.php" method="POST">
      <div>
        <label for="firstname-input">
          <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Z"/></svg>
        </label>
        <input type="text" name="firstname" id="firstname-input" placeholder="Firstname" required>
      </div>
      <div>
        <label for="email-input">
          <span>@</span>
        </label>
        <input type="email" name="email" id="email-input" placeholder="Email" required>
      </div>
      <div>
        <label for="password-input">
          <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm240-200q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80Z"/></svg>
        </label>
        <input type="password" name="password" id="password-input" placeholder="Password" required>
      </div>
      <div>
        <label for="repeat-password-input">
          <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm240-200q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80Z"/></svg>
        </label>
        <input type="password" name="repeat-password" id="repeat-password-input" placeholder="Repeat Password" required>
      </div>
      <button type="submit">Signup</button>
    </form>
    <p>Already have an Account? <a href="login.php">login</a> </p>
  </div>
</body>
</html>