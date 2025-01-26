<?php 
include '../db.php'; 

if (isset($_GET['id'])) {
    $bookId = intval($_GET['id']);
    try {
        $query = "SELECT title, author, description, publication_year, cover_image FROM books WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $bookId, PDO::PARAM_INT);
        $stmt->execute();
        $book = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$book) {
            die("Book not found.");
        }
    } catch (PDOException $e) {
        die("Error fetching book details: " . $e->getMessage());
    }
} else {
    die("Invalid book ID.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($book['title']); ?></title>
    <link rel="stylesheet" href="../css/pagesstyles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #1c1c1c,rgb(58, 26, 26));
            color: white;
        }
        .book-container {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 40px;
            gap: 40px;
        }
        .book-image {
            flex: 1;
            max-width: 400px;
            text-align: center;
        }
        .book-image img {
            max-width: 100%;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
        }
        .book-info {
            flex: 2;
            background: rgba(255, 255, 255, 0.72);
            border-radius: 15px;
            padding: 20px 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .book-info h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #440e1b;
            text-shadow: 1px 1px 2px black;
        }
        .book-info p {
            margin: 10px 0;
            line-height: 1.8;
            font-size: 1.2rem;
        }
        .book-info strong {
            color:rgb(83, 18, 33);
        }
        .back-button {
            margin-top: 20px;
            padding: 10px 20px;
            background: #440e1b;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            text-transform: uppercase;
            font-weight: bold;
            transition: background 0.3s;
        }
        .back-button:hover {
            background: #440e1b;
        }
    </style>
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <div class="book-container">
        <div class="book-image">
            <img src="<?php echo htmlspecialchars($book['cover_image'] ?: '../images/The Iliad.jpeg'); ?>" 
                 alt="<?php echo htmlspecialchars($book['title']); ?>">
        </div>
        <div class="book-info">
            <h1><?php echo htmlspecialchars($book['title']); ?></h1>
            <p><strong>Author:</strong> <?php echo htmlspecialchars($book['author']); ?></p>
            <p><strong>Description:</strong> <?php echo htmlspecialchars($book['description']); ?></p>
            <p><strong>Publication Year:</strong> <?php echo htmlspecialchars($book['publication_year']); ?></p>
            <button class="back-button" onclick="window.history.back()">Go Back</button>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>
</html>
