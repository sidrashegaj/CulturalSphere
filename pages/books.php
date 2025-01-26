<?php
include '../db.php'; // Include your database connection file

// Fetch books from the database
try {
    $query = "SELECT id, title, cover_image FROM books"; // Fetch only required columns
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all books as an associative array
} catch (PDOException $e) {
    die("Error fetching books: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Catalog</title>
    <link rel="stylesheet" href="../css/pagesstyles.css">
    <script src="https://cdn.jsdelivr.net/npm/circletype@2.3.0/dist/circletype.min.js"></script> <!-- Add CircleType.js -->
    <style>
        .circle-text {
            position: absolute; 
            top: 170px; 
            left: 1100px; /* Center it horizontally */
            transform: translate(-50%, -50%); /* Adjust for perfect centering */
            font-family: Arial, sans-serif;
            font-size: 28px;
            color: white;
            cursor: pointer;
            animation: rotate 10s linear infinite; /* Rotate in a circular motion */
            z-index: 10;
            width: 450px; /* Diameter of the circle */
            height: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @keyframes rotate {
            from {
                transform: translate(-50%, -50%) rotate(0deg);
            }
            to {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }

        .circle-text:hover {
            animation-duration: 12s; 
        }
    </style>
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <section class="hero">
        <div class="hero-content">
            <div class="hero-images">
                <img src="../images/books/sectionbooks.jpg" alt="Books Section" class="image-topleft">
                <img src="../images/books/bb.jpg" alt="Book Thief" class="image-bottomleft">
                <img src="../images/books/pp.png" alt="Pride and Prejudiceee" class="image-bottomright">
                <img src="../images/books/harry potter.avif" alt="1984" class="image-topright">
            </div>
            <div class="hero-circle">
                <div id="circle-text" class="circle-text" onclick="scrollToCatalog()">
                    <span>Literary Treasures</span>
                </div>
            </div>
        </div>
    </section>

    <section id="info">
        <div class="info-box">
            <h2>In their inked lines, books carry not just words, but the shadows of 
                their readers, the hopes of their writers, and the pulse of their time.</h2>
        </div>
    </section>

    <main class="catalog" id="catalog-section">
    <?php if (!empty($books)): ?>
        <?php foreach ($books as $book): ?>
            <div class="film"> <!-- Use the same class as 'film' for books -->
                <a href="itembook.php?id=<?php echo htmlspecialchars($book['id']); ?>">
                    <img src="<?php echo !empty($book['cover_image']) ? htmlspecialchars($book['cover_image']) : '../images/The Iliad.jpeg'; ?>"
                         alt="<?php echo htmlspecialchars($book['title']); ?>">
                    <p><?php echo htmlspecialchars($book['title']); ?></p>
                </a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No books available at the moment.</p>
    <?php endif; ?>
    </main>

    <script src="../js/main.js"></script> 


    <?php include '../includes/footer.php'; ?>
</body>
</html>
