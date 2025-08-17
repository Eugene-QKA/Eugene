<header class="navbar">
    <!-- Logo -->
    <div class="logo-container">
        <img src="images/DALL_E_2025-03-11_10.34.39_-_A_modern_and_professional_logo_for_an_E-Waste_Management_system_named__Trash2Tech_-Photoroom-removebg-preview.png"
            alt="E-Waste Logo" class="logo">
    </div>

    <!-- Navigation Links -->
    <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <?php if (isset($_SESSION['admin_id'])): ?>
            <li><a href="dash.php">DashBoard</a></li>
            <li><a href="manage.php">Manage User</a></li>
        <?php endif; ?>
    </ul>


    <?php if (isset($_SESSION['admin_id'])): ?>
        <!-- Logout Button -->
        <a href="logout.php" class="login-btn">Logout</a>
    <?php else: ?>
        <!-- Login Button -->
        <a href="login.php" class="login-btn">Login</a>
    <?php endif; ?>

    <!-- Hamburger Menu -->
    <div class="hamburger">☰</div>
</header>