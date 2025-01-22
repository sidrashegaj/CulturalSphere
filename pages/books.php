<?php
include '../db.php';

// Fetch the book details
$book_id = 1; // Example Book ID
$sql = "SELECT * FROM books WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $book_id);
$stmt->execute();
$book = $stmt->get_result()->fetch_assoc();

// Display the book details
echo "<h1>Book: {$book['title']}</h1>";
echo "<p>Author: {$book['author']}</p>";
echo "<p>Description: {$book['description']}</p>";
?>
