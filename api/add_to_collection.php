<?php
include '../db.php';
session_start();

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized. Please log in.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decode JSON payload
    $data = json_decode(file_get_contents('php://input'), true);

    // Validate incoming data
    if (empty($data['collection_id']) || empty($data['item_type']) || empty($data['item_id'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid data. Please provide all required fields.']);
        exit;
    }

    $collectionId = intval($data['collection_id']);
    $itemType = trim($data['item_type']);
    $itemId = intval($data['item_id']);

    try {
        $query = "INSERT INTO collection_items (collection_id, item_type, item_id) VALUES (:collection_id, :item_type, :item_id)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':collection_id', $collectionId, PDO::PARAM_INT);
        $stmt->bindParam(':item_type', $itemType, PDO::PARAM_STR);
        $stmt->bindParam(':item_id', $itemId, PDO::PARAM_INT);
        $stmt->execute();

        echo json_encode(['message' => 'Item added to collection successfully.']);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Error adding item to collection: ' . $e->getMessage()]);
    }
}
