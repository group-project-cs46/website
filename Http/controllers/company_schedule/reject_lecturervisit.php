<?php

namespace Controllers;

use Models\CompanyLecturerVisit;

header('Content-Type: application/json');

// Handle reject action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'reject') {
    $visitId = $_POST['visit_id'] ?? null;

    if (empty($visitId)) {
        echo json_encode(['success' => false, 'error' => 'Invalid visit ID']);
        exit();
    }

    try {
        CompanyLecturerVisit::rejectVisit($visitId);
        echo json_encode(['success' => true]);
        exit();
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => 'Failed to reject visit']);
        exit();
    }
}

echo json_encode(['success' => false, 'error' => 'Invalid request']);
exit();