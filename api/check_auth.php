<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['isAuthenticated' => false]);
    exit;
}

echo json_encode(['isAuthenticated' => true]);
?>
