<?php

use Models\pdc_complaints;

header('Content-Type: application/json');
session_start(); // Needed for CSRF token validation

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    // Validate CSRF token
    if (!isset($data['csrf_token']) || $data['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
        http_response_code(403);
        echo json_encode(['success' => false, 'error' => 'Invalid CSRF token']);
        exit();
    }

    // Validate complaint ID
    if (!isset($data['id']) || !is_numeric($data['id']) || $data['id'] <= 0) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Invalid or missing complaint ID']);
        exit();
    }

    try {
        pdc_complaints::complaintsolved((int)$data['id']);
        http_response_code(200);
        echo json_encode(['success' => true, 'message' => 'Complaint marked as solved']);
    } catch (Exception $e) {
        error_log("Error solving complaint: " . $e->getMessage());
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => 'Failed to mark complaint as solved']);
    }
    exit();
}

http_response_code(405); // Method Not Allowed
echo json_encode(['success' => false, 'error' => 'Method not allowed']);
exit();
