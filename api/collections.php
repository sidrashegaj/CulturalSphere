<?php
include '../db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized. Please log in.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);

    if (empty($name)) {
        http_response_code(400);
        echo json_encode(['error' => 'Collection name is required.']);
        exit;
    }

    try {
        $query = "INSERT INTO collections (user_id, name, description) VALUES (:user_id, :name, :description)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->execute();

        echo json_encode(['message' => 'Collection created successfully']);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Error creating collection: ' . $e->getMessage()]);
    }
    exit;
}

if (isset($_GET['id'])) {
    $collectionId = intval($_GET['id']);
    try {
        $query = "SELECT ci.item_type, ci.item_id, 
        f.title AS film_title, 
        b.title AS book_title, 
        b.cover_image AS book_cover_image,  
        a.name AS art_name, 
        a.image_path AS art_image_path
 FROM collection_items ci
 LEFT JOIN films f ON ci.item_id = f.id AND ci.item_type = 'film'
 LEFT JOIN books b ON ci.item_id = b.id AND ci.item_type = 'book'
 LEFT JOIN art a ON ci.item_id = a.id AND ci.item_type = 'art'
 WHERE ci.collection_id = :collection_id";


        $stmt = $conn->prepare($query);
        $stmt->bindParam(':collection_id', $collectionId, PDO::PARAM_INT);
        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$items) {
            http_response_code(404);
            echo json_encode(['error' => 'No items found for this collection.']);
            exit;
        }

        echo json_encode($items);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $userId = $_SESSION['user_id'];
    try {
        $query = "SELECT * FROM collections WHERE user_id = :user_id ORDER BY created_at DESC";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $collections = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($collections);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Error fetching collections: ' . $e->getMessage()]);
    }
}


$id = $_GET['id'] ?? null;

// Log the ID for debugging
error_log("Received DELETE request for collection ID: $id");


if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = $_GET['id'] ?? null;

    // Log the ID received
    error_log("Received DELETE request for collection ID: $id");

    if (!$id || !filter_var($id, FILTER_VALIDATE_INT)) {
        http_response_code(400);
        echo json_encode(['error' => 'Valid collection ID is required']);
        exit;
    }

    try {
        $conn->beginTransaction();

        // Attempt to delete related items
        $deleteItemsStmt = $conn->prepare("DELETE FROM collection_items WHERE collection_id = ?");
        $deleteItemsStmt->execute([$id]);
        error_log("Attempted to delete items for collection ID: $id");

        // Delete the collection
        $deleteCollectionStmt = $conn->prepare("DELETE FROM collections WHERE id = ?");
        $deleteCollectionStmt->execute([$id]);

        if ($deleteCollectionStmt->rowCount() > 0) {
            $conn->commit();
            http_response_code(200);
            echo json_encode(['message' => 'Collection deleted successfully']);
        } else {
            // No collection found to delete
            $conn->rollBack();
            http_response_code(404);
            echo json_encode(['error' => 'Collection not found']);
        }
    } catch (PDOException $e) {
        $conn->rollBack();
        error_log("Error deleting collection: " . $e->getMessage());
        http_response_code(500);
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
    exit;
}


?>
