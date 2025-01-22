<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cultural Sphere - Home</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script
    type="text/javascript"
    src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js">
  </script>
</head>
<body>

<!-- Include Header -->
<?php include 'includes/header.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Hero Section -->
<header class="hero-section">
    <video autoplay muted loop class="bg-video">
        <source src="images/backgmain.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="content">
        <h1 class="display-3 fw-bold text-uppercase">Cultural Sphere</h1>
        <p class="lead mt-3">The beauty of the world lies in the diversity of its people and stories.</p>
        <button class="btn text-dark mt-4 px-4 py-2" onclick="window.location.href='contact.html';">Discover</button>
    </div>
</header>

<!-- Remaining Content -->
<section id="info">
    <div class="info-box">
        <i class="bi bi-geo-alt"></i>
        <h5>Address</h5>
        <p>6724 13th Ave, Brooklyn, <br> NY 11219</p>
    </div>
    <div class="info-box">
        <i class="bi bi-telephone"></i>
        <h5>Phone</h5>
        <p>+1-646-656-2002</p>
    </div>
    <div class="info-box">
        <i class="bi bi-envelope"></i>
        <h5>Email</h5>
        <p>info@titaniumelectrical.us</p>
    </div>
    <div class="info-box">
        <i class="bi bi-hand-thumbs-up"></i>
        <h5>Connect</h5>
        <div class="social-icons">
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="bi bi-twitter"></i></a>
            <a href="#"><i class="bi bi-linkedin"></i></a>
            <a href="#"><i class="bi bi-instagram"></i></a>
        </div>
    </div>
</section>

<!-- Other sections like about, testimonials, services remain unchanged -->

<!-- Footer -->
<footer class="bg-dark text-white text-center py-4">
    <div class="container">
        <p class="mb-0">Titanium Electrical</p>
        <p>Powering a Greener Tomorrow: Electrical Solutions for All Your Needs</p>
        <small>©2023 by Titanium Electrical</small>
    </div>
</footer>

<script src="js/scripts.js"></script>
</body>
</html>
