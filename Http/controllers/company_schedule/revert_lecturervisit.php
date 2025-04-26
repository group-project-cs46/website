<?php

namespace Controllers;

use Models\CompanyLecturerVisit;

header('Content-Type: application/json');

// Handle revert action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'revert') {
    $visitId = $_POST['visit_id'] ?? null;

    if (empty($visitId)) {
        echo json_encode(['success' => false, 'error' => 'Invalid visit ID']);
        exit();
    }

    try {
        CompanyLecturerVisit::revertStatus($visitId);
        echo json_encode(['success' => true]);
        exit();
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => 'Failed to revert visit approval']);
        exit();
    }
}

echo json_encode(['success' => false, 'error' => 'Invalid request']);
exit();