<?php
// Http/controllers/PDC/pdc_edit_visit.php

use Models\pdcCompanyvisit;

// Get the POST data
$id = $_POST['id'] ?? null;
$date = $_POST['date'] ?? null;
$time = $_POST['time'] ?? null;
$lecturer_id = $_POST['lecturer_id'] ?? null;

// Validate input
if (!$id || !$date || !$time || !$lecturer_id) {
    header('Content-Type: application/json');
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Invalid input: ID, date, time, and lecturer ID are required']);
    exit;
}

try {
    $result = pdcCompanyvisit::edit_visit($id, $date, $time, $lecturer_id);
    
    header('Content-Type: application/json');
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Visit updated successfully']);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => 'Failed to update visit']);
    }
} catch (Exception $e) {
    header('Content-Type: application/json');
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Database error: ' . $e->getMessage()]);
}
