<?php

namespace Controllers;

use Models\CompanyLecturerVisit;

header('Content-Type: application/json');

// Handle approve action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'approve') {
    $visitId = $_POST['visit_id'] ?? null;

    if (empty($visitId)) {
        echo json_encode(['success' => false, 'error' => 'Invalid visit ID']);
        exit();
    }

    try {
        CompanyLecturerVisit::updateStatus($visitId, true);
        echo json_encode(['success' => true]);
        exit();
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => 'Failed to approve visit']);
        exit();
    }
}

echo json_encode(['success' => false, 'error' => 'Invalid request']);
exit();