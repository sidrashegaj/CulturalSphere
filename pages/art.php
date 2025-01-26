<?php 
include '../db.php'; // Include your database connection file

// Fetch art from the database
try {
    $query = "SELECT id, name, image_path FROM art"; // Fetch required columns, including image_path
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $arts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching art: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art Catalog</title>
    <link rel="stylesheet" href="../css/pagesstyles.css">
    <script src="https://cdn.jsdelivr.net/npm/circletype@2.3.0/dist/circletype.min.js"></script>
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <section class="hero">
        <div class="hero-content">
            <div class="hero-images">
                <!-- Hero images are hardcoded -->
                <img src="../images/art/Bal_du_moulin_de_la_Galette.jpg" alt="Artwork 1" class="image-topleft">
                <img src="../images/art/A_Sunday_Afternoon_on_the_Island.jpg" alt="Artwork 2" class="image-bottomleft">
                <img src="../images/art/Starry_Night.jpg" alt="Artwork 3" class="image-bottomright">
                <img src="../images/art/The_Fighting_Temeraire.jpg" alt="Artwork 4" class="image-topright">
            </div>
            <div class="hero-circle">
                <div id="circle-text" class="circle-text" onclick="scrollToCatalog()">
                    <span> Artistic &#9675; Culture &#9675;</span>
                </div>
            </div>
        </div>
    </section>

    <section class="info">
        <div class="info-box">
            <h2>Art is the highest form of hope and a timeless reflection of human creativity and emotion.</h2>
        </div>
    </section>

    <main class="art-catalog">
    <?php if (!empty($arts)): ?>
        <?php foreach ($arts as $art): ?>
            <div class="art-card">
                <a href="itemart.php?id=<?php echo htmlspecialchars($art['id']); ?>">
                    <div class="art-image-container">
                        <div class="art-image"
                            style="background-image: url('<?php echo htmlspecialchars('../' . $art['image_path']); ?>');">
                        </div>
                    </div>
                    <p><?php echo htmlspecialchars($art['name']); ?></p>
                </a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No art available at the moment.</p>
    <?php endif; ?>
    </main>

    <script src="../js/main.js"></script> 
    <?php include '../includes/footer.php'; ?>
</body>
</html>
