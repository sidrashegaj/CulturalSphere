<?php
include '../db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if user is logged in
    $userId = $_SESSION['user_id'] ?? null;
    if (!$userId) {
        echo json_encode(['error' => 'You must be logged in to comment.']);
        exit;
    }

    // Decode JSON data
    $data = json_decode(file_get_contents('php://input'), true);
    $bookId = $data['book_id'] ?? null;
    $comment = $data['comment'] ?? null;

    if (!$bookId || !$comment) {
        echo json_encode(['error' => 'Book ID and comment are required.']);
        exit;
    }

    try {
        // Insert comment into the database
        $query = "INSERT INTO book_comments (book_id, user_id, comment, created_at) 
                  VALUES (:book_id, :user_id, :comment, NOW())";
        $stmt = $conn->prepare($query);
        $stmt->execute([
            'book_id' => $bookId,
            'user_id' => $userId,
            'comment' => $comment
        ]);

        echo json_encode(['success' => true, 'message' => 'Comment posted successfully.']);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error posting comment: ' . $e->getMessage()]);
    }
}
?>
