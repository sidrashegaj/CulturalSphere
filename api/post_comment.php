<?php
include '../db.php';
session_start();

header('Content-Type: application/json');

//check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'You need to be logged in to post a comment.']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$filmId = intval($data['film_id']);
$comment = trim($data['comment']);
$userId = $_SESSION['user_id'];

if (empty($comment)) {
    echo json_encode(['error' => 'Comment cannot be empty.']);
    exit;
}

try {
    //insert comment into outr database
    $query = "INSERT INTO comments (film_id, user_id, comment) VALUES (:film_id, :user_id, :comment)";
    $stmt = $conn->prepare($query);
    $stmt->execute(['film_id' => $filmId, 'user_id' => $userId, 'comment' => $comment]);

    echo json_encode(['message' => 'Comment added successfully.']);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error adding comment: ' . $e->getMessage()]);
}

?>
