<?php
session_start();

header('Content-Type: application/json');

// Accept JSON input
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['user_id']) && isset($data['role'])) {
    $_SESSION['user_id'] = $data['user_id'];
    $_SESSION['role'] = $data['role'];
    echo json_encode(['status' => 'success']);
} else {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Invalid session data']);
}
error_log("Session User ID: " . ($_SESSION['user_id'] ?? 'none'));
error_log("Session Role: " . ($_SESSION['role'] ?? 'none'));
