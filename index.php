<?php
include 'db.php'; // Include your database connection file

try {
    // Fetch top 3 films by likes
    $films = $conn->query("SELECT title, cover_image, likes FROM films ORDER BY likes DESC LIMIT 3")->fetchAll(PDO::FETCH_ASSOC);

    // Fetch top 3 books by likes
    $books = $conn->query("SELECT title, cover_image, likes FROM books ORDER BY likes DESC LIMIT 3")->fetchAll(PDO::FETCH_ASSOC);

    // Fetch top 3 art pieces by likes
    $art = $conn->query("SELECT title, cover_image, likes FROM art ORDER BY likes DESC LIMIT 3")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching data: " . $e->getMessage());
}
?>

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
    <!-- Hero Section -->
    <header class="hero-section">
        <video autoplay muted loop class="bg-video">
            <source src="images/backgmain.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="content">
            <h1 class="display-3 fw-bold text-uppercase">Cultural Sphere</h1>
            <p class="lead mt-3">The beauty of the world lies in the diversity of its people and stories.</p>
            <!-- Discover Button with Dropdown -->
            <div class="dropdown">
                <button class="btn text-dark mt-4 px-4 py-2">Explore</button>
                <div class="dropdown-menu">
                    <a href="pages/films.php">Cinematic Culture</a>
                    <a href="pages/books.php">Literary Legacy</a>
                    <a href="pages/art.php">Visual Symphonies</a>
                </div>
            </div>
        </div>
    </header>

    <section id="info">
        <div class="info-box">
            <h1>Celebrate Culture</h1>
            <h2>Top 3 Picks of the Day</h2>
        </div>
    </section>

    <section class="trending films">
    <div class="description-text">
        <h1>Cinema Picks</h1>
    </div>
    <div class="card-wrap">
        <?php foreach ($films as $film): ?>
            <div class="card" style="background-image: url('../images/films/<?php echo $film['cover_image']; ?>'); background-size: cover; background-position: center;">
                <div class="card-content">
                    <h3><?php echo $film['title']; ?></h3>
                    <p>Likes: <?php echo $film['likes']; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="trending books">
    <div class="description-text">
        <h1>Top Reads</h1>
    </div>
    <div class="card-wrap">
        <?php foreach ($books as $book): ?>
            <div class="card" style="background-image: url('../images/books/<?php echo $book['cover_image']; ?>'); background-size: cover; background-position: center;">
                <div class="card-content">
                    <h3><?php echo $book['title']; ?></h3>
                    <p>Likes: <?php echo $book['likes']; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="trending art">
    <div class="description-text">
        <h1>Gallery Highlights</h1>
    </div>
    <div class="card-wrap">
        <?php foreach ($art as $piece): ?>
            <div class="card" style="background-image: url('../images/art/<?php echo $piece['image']; ?>'); background-size: cover; background-position: center;">
                <div class="card-content">
                    <h3><?php echo $piece['title']; ?></h3>
                    <p>Likes: <?php echo $piece['likes']; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>


    <!-- Include Footer -->
    <?php include 'includes/footer.php'; ?>
</body>
</html>
