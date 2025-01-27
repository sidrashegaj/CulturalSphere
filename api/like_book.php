<?php
session_start();
include '../db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'You must be logged in to like a book.']);
    exit;
}

$userId = $_SESSION['user_id'];
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['book_id'])) {
    echo json_encode(['error' => 'Book ID is required.']);
    exit;
}

$bookId = intval($data['book_id']);

try {
    // Check if the user has already liked the book
    $checkQuery = "SELECT 1 FROM book_likes WHERE user_id = :user_id AND book_id = :book_id";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->execute(['user_id' => $userId, 'book_id' => $bookId]);

    if ($checkStmt->rowCount() > 0) {
        // Unlike the book
        $deleteQuery = "DELETE FROM book_likes WHERE user_id = :user_id AND book_id = :book_id";
        $deleteStmt = $conn->prepare($deleteQuery);
        $deleteStmt->execute(['user_id' => $userId, 'book_id' => $bookId]);

        // Decrement like count
        $updateLikes = "UPDATE books SET likes = likes - 1 WHERE id = :book_id";
        $updateStmt = $conn->prepare($updateLikes);
        $updateStmt->execute(['book_id' => $bookId]);

        echo json_encode(['liked' => false, 'likes' => getLikeCount($bookId, $conn)]);
    } else {
        // Like the book
        $insertQuery = "INSERT INTO book_likes (user_id, book_id) VALUES (:user_id, :book_id)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->execute(['user_id' => $userId, 'book_id' => $bookId]);

        // Increment like count
        $updateLikes = "UPDATE books SET likes = likes + 1 WHERE id = :book_id";
        $updateStmt = $conn->prepare($updateLikes);
        $updateStmt->execute(['book_id' => $bookId]);

        echo json_encode(['liked' => true, 'likes' => getLikeCount($bookId, $conn)]);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    exit;
}

// Helper function to get the current like count
function getLikeCount($bookId, $conn) {
    $query = "SELECT likes FROM books WHERE id = :book_id";
    $stmt = $conn->prepare($query);
    $stmt->execute(['book_id' => $bookId]);
    return $stmt->fetchColumn();
}

?>
