<?php
session_start();
include '../db_con.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = trim($_POST['email']);
  $password = $_POST['password'];

  // Prepare and execute query
  $stmt = $conn->prepare("SELECT id, name, password, role FROM users WHERE email = ? AND role = 'admin'");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->store_result();

  // If user exists
  if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $name, $hashed_password, $role);
    $stmt->fetch();

    // Verify password
    if (password_verify($password, $hashed_password)) {
      // Set session
      $_SESSION['admin_id'] = $id;
      $_SESSION['admin_name'] = $name;
      $_SESSION['admin_role'] = $role;

      // Redirect to dashboard or home page
      if (isset($_GET['redirect'])) {
        $redirectPage = $_GET['redirect'];
        header("Location: $redirectPage");
        exit();
      } else {
        header("Location: dash.php");
        exit();
      }
    } else {
      $error = "Incorrect password.";
    }
  } else {
    $error = "No admin found with that email.";
  }

  $stmt->close();

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="css/style.css">
  <script type="text/javascript" src="js/validation.js" defer></script>
  <link rel="icon" type="image/png" href="images/Small icon.png">
</head>

<body>
  <div class="wrapper">
    <div class="logo">
      <img src="images/Small Logo.jpg" alt="E-Waste Logo"> <!-- Make sure to replace with your logo -->
    </div>
    <h1>Login</h1>
    <?php if (!empty($error))
      echo "<p style='color:red;'>$error</p>"; ?>
    <form id="form" action="" method="POST">
      <div>
        <label for="email-input">
          <span>@</span>
        </label>
        <input type="email" name="email" id="email-input" placeholder="Email" required>
      </div>
      <div>
        <label for="password-input">
          <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
            <path
              d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm240-200q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80Z" />
          </svg>
        </label>
        <input type="password" name="password" id="password-input" placeholder="Password" required>
      </div>
      <button type="submit">Login</button>
    </form>
  </div>
</body>

</html>