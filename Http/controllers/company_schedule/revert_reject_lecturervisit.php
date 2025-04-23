<?php

namespace Controllers;

use Models\CompanyLecturerVisit;

header('Content-Type: application/json');

// Handle revert reject action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'revert_reject') {
    $visitId = $_POST['visit_id'] ?? null;

    if (empty($visitId)) {
        echo json_encode(['success' => false, 'error' => 'Invalid visit ID']);
        exit();
    }

    try {
        CompanyLecturerVisit::revertReject($visitId);
        echo json_encode(['success' => true]);
        exit();
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => 'Failed to revert rejection']);
        exit();
    }
}

echo json_encode(['success' => false, 'error' => 'Invalid request']);
exit();