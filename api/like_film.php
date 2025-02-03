<?php
include '../db.php';
session_start();

header('Content-Type: application/json');

//check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'You need to be logged in to like a post.']);
    exit;
}

$userId = $_SESSION['user_id'];
$data = json_decode(file_get_contents('php://input'), true);
$filmId = intval($data['film_id']);

try {
    //check if user already liked film
    $query = "SELECT * FROM film_likes WHERE user_id = :user_id AND film_id = :film_id";
    $stmt = $conn->prepare($query);
    $stmt->execute(['user_id' => $userId, 'film_id' => $filmId]);

    if ($stmt->rowCount() > 0) {
        //unlike film
        $query = "DELETE FROM film_likes WHERE user_id = :user_id AND film_id = :film_id";
        $conn->prepare($query)->execute(['user_id' => $userId, 'film_id' => $filmId]);

        //decrement like count
        $query = "UPDATE films SET likes = likes - 1 WHERE id = :film_id";
        $conn->prepare($query)->execute(['film_id' => $filmId]);

        echo json_encode(['liked' => false, 'likes' => getLikes($filmId, $conn)]);
    } else {
        //like film
        $query = "INSERT INTO film_likes (user_id, film_id) VALUES (:user_id, :film_id)";
        $conn->prepare($query)->execute(['user_id' => $userId, 'film_id' => $filmId]);

        //increment like count
        $query = "UPDATE films SET likes = likes + 1 WHERE id = :film_id";
        $conn->prepare($query)->execute(['film_id' => $filmId]);

        echo json_encode(['liked' => true, 'likes' => getLikes($filmId, $conn)]);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error processing request: ' . $e->getMessage()]);
}

function getLikes($filmId, $conn) {
    $query = "SELECT likes FROM films WHERE id = :film_id";
    $stmt = $conn->prepare($query);
    $stmt->execute(['film_id' => $filmId]);
    return $stmt->fetchColumn();
}

?>
