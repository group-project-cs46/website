<?php

use Models\pdc_studentreport;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $reports = pdc_studentreport::fetchAll(); // <-- This was missing
    echo json_encode($reports);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['delete_id'])) {
        pdc_studentreport::delete($data['delete_id']);
        echo json_encode(['success' => true]);
        exit();
    }
}

echo json_encode(['success' => false]);
exit();
?>
