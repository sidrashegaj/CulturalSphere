<?php
include '../db.php';

//fetch films from cultural_sphere database
try {
    $query = "SELECT id, title, cover_image FROM films";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $films = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching films: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film Catalog</title>
    <link rel="stylesheet" href="../css/pagesstyles.css">
    <script src="https://cdn.jsdelivr.net/npm/circletype@2.3.0/dist/circletype.min.js"></script>
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <section class="hero">
        <div class="hero-content">
            <div class="hero-images">
                <img src="../images/films/filmscene.jpg" alt="Citizen Kane" class="image-topleft">
                <img src="../images/films/filmscene2.jpg" alt="The Godfather" class="image-bottomleft">
                <img src="../images/films/filmscene3.jpg" alt="Dr. Strangelove" class="image-bottomright">
                <img src="../images/films/filmscene4.jpg" alt="The Book Thief" class="image-topright">
            </div>
            <div class="hero-circle">
                <div id="circle-text" class="circle-text" onclick="scrollToCatalog()">
                    <span> Cinematic &#9675; Culture &#9675;</span>
                </div>
            </div>
        </div>
    </section>

    <section class="info">
        <div class="info-box">
            <h2>Cinema took storytelling by the hand and made it dance; 
                its frames turned whispers into thunder, reshaping how we see ourselves.</h2>
        </div>
    </section>

    <main class="catalog" id="catalog-section">
    <?php if (!empty($films)): ?>
        <?php foreach ($films as $film): ?>
            <div class="film">
                <a href="itemfilm.php?id=<?php echo htmlspecialchars($film['id']); ?>">
                    <img src="<?php echo !empty($film['cover_image']) ? htmlspecialchars($film['cover_image']) : '../images/Avatar.jpg'; ?>"
                         alt="<?php echo htmlspecialchars($film['title']); ?>">
                    <p><?php echo htmlspecialchars($film['title']); ?></p>
                </a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No films available at the moment.</p>
    <?php endif; ?>
    </main>

    <script src="../js/main.js"></script> 
    <?php include '../includes/footer.php'; ?>

</body>
</html>
