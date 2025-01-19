<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cultural Sphere - Home</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <!-- Include Navbar -->
    <?php include 'includes/header.php'; ?>
    
    <!-- Hero Section -->
    <header class="hero-section">
        <h1 class="display-3 fw-bold text-uppercase">Cultural Sphere</h1>
        <p class="lead mt-3">Discover the interconnections between books, movies, art, and locations.</p>
        <button class="btn text-dark mt-4 px-4 py-2" onclick="window.location.href='categories.php';">Explore Now</button>
    </header>

    <!-- Categories Section -->
    <section id="categories" class="py-5">
        <div class="container">
            <h2 class="text-center">Explore Categories</h2>
            <div class="row mt-4">
                <div class="col-md-3 text-center">
                    <img src="images/books.jpg" alt="Books" class="img-fluid rounded">
                    <h5 class="mt-2">Books</h5>
                </div>
                <div class="col-md-3 text-center">
                    <img src="images/movies.jpg" alt="Movies" class="img-fluid rounded">
                    <h5 class="mt-2">Movies</h5>
                </div>
                <div class="col-md-3 text-center">
                    <img src="images/art.jpg" alt="Art" class="img-fluid rounded">
                    <h5 class="mt-2">Art</h5>
                </div>
                <div class="col-md-3 text-center">
                    <img src="images/locations.jpg" alt="Locations" class="img-fluid rounded">
                    <h5 class="mt-2">Locations</h5>
                </div>
            </div>
        </div>
    </section>

    <!-- Include Footer -->
    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
