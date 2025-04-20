<?php

use Models\pdc_complaints;

header('Content-Type: application/json');

session_start(); // For CSRF token validation

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        // Check if a specific complaint ID is requested
        if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
            $complaint = pdc_complaints::fetchById((int)$_GET['id']);
            if (!$complaint) {
                http_response_code(404);
                echo json_encode(['success' => false, 'error' => 'Complaint not found']);
                exit();
            }
            http_response_code(200);
            echo json_encode($complaint);
        } else {
            // Fetch all complaints
            $complaints = pdc_complaints::fetchAll();
            http_response_code(200);
            echo json_encode($complaints);
        }
    } catch (Exception $e) {
        error_log("API GET error: " . $e->getMessage());
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => 'Failed to fetch complaints: ' . $e->getMessage()]);
    }
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    // Validate CSRF token
    if (!isset($data['csrf_token']) || $data['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
        http_response_code(403);
        echo json_encode(['success' => false, 'error' => 'Invalid CSRF token']);
        exit();
    }

    // Check if complaint ID to reject is present
    if (isset($data['id']) && is_numeric($data['id']) && $data['id'] > 0) {
        try {
            $affectedRows = pdc_complaints::rejectcomplaint((int)$data['id']);
            if ($affectedRows === 0) {
                http_response_code(404);
                echo json_encode(['success' => false, 'error' => 'Complaint not found']);
            } else {
                http_response_code(200);
                echo json_encode(['success' => true, 'message' => 'Complaint rejected']);
            }
        } catch (Exception $e) {
            error_log("API POST error: " . $e->getMessage());
            http_response_code(500);
            echo json_encode(['success' => false, 'error' => 'Failed to reject complaint: ' . $e->getMessage()]);
        }
    } else {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Invalid or missing complaint ID']);
    }
    exit();
}

http_response_code(405);
echo json_encode(['success' => false, 'error' => 'Method not allowed']);
exit();