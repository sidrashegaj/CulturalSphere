<?php 
session_start();
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-black py-3">
    <div class="container">
        <a class="navbar-brand fw-bold text-light" href="index.php">CULTURAL <span>SPHERE</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link " href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link " href="about.html">About</a></li>
                <li class="nav-item"><a class="nav-link " href="contact.html">Contact</a></li>
                <li class="nav-item"><a class="nav-link " href="services.html">Services</a></li>
                <li class="nav-item"><a class="nav-link " href="testimonials.html">Testimonials</a></li>
                <!-- Dynamic Login/Register or Profile Section -->
                <li class="nav-item" id="auth-section">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <!-- Profile and Logout Buttons for Logged-In Users -->
                        <div id="user-profile" class="d-flex align-items-center">
                            <a href="profile.php" class="nav-link d-flex align-items-center">
                                <img src="profile-icon.png" alt="Profile" class="rounded-circle me-2" width="30" height="30">
                                <span class="text-light">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                            </a>
                            <a class="btn btn-outline-light ms-2" href="pages/logout.php">Logout</a>
                        </div>
                    <?php else: ?>
                        <!-- Login and Register Buttons for Guests -->
                        <div id="guest-buttons" class="d-flex">
                            <a class="btn btn-outline me-2" href="pages/login.php">Login</a>
                            <a class="btn btn-outline" href="pages/register.php">Register</a>
                        </div>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
</nav>
