<?php

use Models\PdcAdvertisements;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = $_GET['action'] ?? 'all';
    if ($action === 'approved') {
        $advertisements = PdcAdvertisements::fetchApproved();
    } else {
        $advertisements = PdcAdvertisements::fetchAll();
    }
    echo json_encode($advertisements);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['approve_id'])) {
        PdcAdvertisements::approve($data['approve_id']);
        echo json_encode(['success' => true, 'message' => 'Advertisement approved successfully']);
        exit();
    }

    if (isset($data['reject_id']) && isset($data['reason'])) {
        PdcAdvertisements::reject($data['reject_id']);
        // TODO: Store or log the rejection reason if needed
        echo json_encode(['success' => true, 'message' => 'Advertisement rejected successfully']);
        exit();
    }

    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit();
}