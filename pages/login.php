<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cultural Sphere</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <!-- Video Background -->
    <div class="video-bg">
        <video autoplay muted loop class="bg-video">
            <source src="../images/background_login - Made with Clipchamp.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="overlay"></div> <!-- Add an overlay to darken the video -->
    </div>

    <!-- Login Section -->
    <section class="login-section">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row shadow-lg rounded-5" style="max-width: 500px; background-color: rgba(255, 255, 255, 0.9);">
            <!-- Login Form -->
            <div class="col-md-12 p-5">
                <h2 class="text-center mb-4 text-dark">Welcome Back</h2>
                <p class="text-center text-muted mb-4">Log in to access your personalized dashboard</p>
                <form action="../pages/validate-login.php" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label text-dark">Email</label>
                        <input type="email" class="form-control rounded-pill" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label text-dark">Password</label>
                        <input type="password" class="form-control rounded-pill" id="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <a href="#" class="text-decoration-none text-muted">Forgot password?</a>
                    </div>
                    <button type="submit" class="btn btn-warning w-100 rounded-pill">Log In</button>
                    <p class="text-center mt-3 text-dark">
                        Don’t have an account? 
                        <a href="register.php" class="text-decoration-none text-warning fw-bold">Sign Up</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
