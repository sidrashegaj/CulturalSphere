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
    $artId = $data['art_id'] ?? null;
    $comment = $data['comment'] ?? null;

    if (!$artId || !$comment) {
        echo json_encode(['error' => 'Art ID and comment are required.']);
        exit;
    }

    try {
        // Insert comment into the database
        $query = "INSERT INTO art_comments (art_id, user_id, comment, created_at) 
                  VALUES (:art_id, :user_id, :comment, NOW())";
        $stmt = $conn->prepare($query);
        $stmt->execute([
            'art_id' => $artId,
            'user_id' => $userId,
            'comment' => $comment
        ]);

        echo json_encode(['success' => true, 'message' => 'Comment posted successfully.']);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error posting comment: ' . $e->getMessage()]);
    }
}
?>
