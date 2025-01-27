<?php
session_start();
include '../db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'You must be logged in to like an art piece.']);
    exit;
}

$userId = $_SESSION['user_id'];
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['art_id'])) {
    echo json_encode(['error' => 'Art ID is required.']);
    exit;
}

$artId = intval($data['art_id']);

try {
    // Check if the user has already liked the art
    $checkQuery = "SELECT 1 FROM art_likes WHERE user_id = :user_id AND art_id = :art_id";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->execute(['user_id' => $userId, 'art_id' => $artId]);

    if ($checkStmt->rowCount() > 0) {
        // Unlike the art
        $deleteQuery = "DELETE FROM art_likes WHERE user_id = :user_id AND art_id = :art_id";
        $deleteStmt = $conn->prepare($deleteQuery);
        $deleteStmt->execute(['user_id' => $userId, 'art_id' => $artId]);

        // Decrement like count
        $updateLikes = "UPDATE art SET likes = likes - 1 WHERE id = :art_id";
        $updateStmt = $conn->prepare($updateLikes);
        $updateStmt->execute(['art_id' => $artId]);

        echo json_encode(['liked' => false, 'likes' => getLikeCount($artId, $conn)]);
    } else {
        // Like the art
        $insertQuery = "INSERT INTO art_likes (user_id, art_id) VALUES (:user_id, :art_id)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->execute(['user_id' => $userId, 'art_id' => $artId]);

        // Increment like count
        $updateLikes = "UPDATE art SET likes = likes + 1 WHERE id = :art_id";
        $updateStmt = $conn->prepare($updateLikes);
        $updateStmt->execute(['art_id' => $artId]);

        echo json_encode(['liked' => true, 'likes' => getLikeCount($artId, $conn)]);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    exit;
}

// Helper function to get the current like count
function getLikeCount($artId, $conn) {
    $query = "SELECT likes FROM art WHERE id = :art_id";
    $stmt = $conn->prepare($query);
    $stmt->execute(['art_id' => $artId]);
    return $stmt->fetchColumn();
}
?>
