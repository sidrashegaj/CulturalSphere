<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
//determine base path dynamically
$base_path = (strpos($_SERVER['PHP_SELF'], '/pages/') !== false) ? '../' : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cultural Sphere</title>
    <!--Dynamic paths for CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $base_path; ?>css/navbar.css">
    <link rel="stylesheet" href="<?php echo $base_path; ?>css/style.css">
    <link rel="stylesheet" href="<?php echo $base_path; ?>css/pagestyles.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-black py-3">
        <div class="container">
            <a class="navbar-brand fw-bold text-light" href="<?php echo $base_path; ?>index.php">CULTURAL <span>SPHERE</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="<?php echo $base_path; ?>index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $base_path; ?>pages/films.php">Films</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $base_path; ?>pages/books.php">Books</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $base_path; ?>pages/art.php">Art</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $base_path; ?>pages/collections.php">Collections</a></li>
                    <li class="nav-item" id="auth-section">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <div id="user-profile" class="d-flex align-items-center">
                                <a href="<?php echo $base_path; ?>pages/collections.php" class="nav-link d-flex align-items-center">
                                    <i class="bi bi-person-circle text-light fs-4 me-2"></i>
                                    <span class="text-light">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                                </a>
                                <a class="btn btn-outline ms-2" href="<?php echo $base_path; ?>pages/logout.php">Logout</a>
                            </div>
                        <?php else: ?>
                            <div id="guest-buttons" class="d-flex">
                                <a class="btn btn-outline me-2" href="<?php echo $base_path; ?>pages/login.php">Login</a>
                                <a class="btn btn-outline" href="<?php echo $base_path; ?>pages/register.php">Register</a>
                            </div>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</body>
</html>
