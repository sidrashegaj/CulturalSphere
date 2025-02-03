<?php
include '../db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header("Content-Type: application/json");

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized. Please log in.']);
    exit;
}

$userId = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    if (!isset($data['name']) || empty(trim($data['name']))) {
        http_response_code(400);
        echo json_encode(['error' => 'Collection name is required.']);
        exit;
    }

    $name = trim($data['name']);
    $description = trim($data['description'] ?? '');

    try {
        $stmt = $conn->prepare("INSERT INTO collections (user_id, name, description) VALUES (?, ?, ?)");
        $stmt->execute([$userId, $name, $description]);

        http_response_code(201);
        echo json_encode(['message' => 'Collection created successfully']);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Error creating collection: ' . $e->getMessage()]);
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        //fetch items for a specific collection
        $collectionId = intval($_GET['id']);
        try {
            $query = "
                SELECT 
                    ci.item_type, ci.item_id, 
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

            echo json_encode($items);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
        }
    } else {
        //fetch all collections
        try {
            $stmt = $conn->prepare("SELECT * FROM collections WHERE user_id = ? ORDER BY created_at DESC");
            $stmt->execute([$userId]);
            echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Error fetching collections: ' . $e->getMessage()]);
        }
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $_DELETE);
    $collectionId = $_GET['id'] ?? $_DELETE['id'] ?? null;

    if (!$collectionId) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid collection ID.']);
        exit;
    }

    try {
        $stmt = $conn->prepare("DELETE FROM collections WHERE id = ? AND user_id = ?");
        $stmt->execute([$collectionId, $userId]);
        http_response_code(200);
        echo json_encode(['message' => 'Collection deleted successfully']);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
    exit;
}
?>
