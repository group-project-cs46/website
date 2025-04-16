<?php
use Models\pdc_techtalk;
use Core\App;
use Core\Database;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    // Ensure $id is a valid integer
    if ($id === null || $id === '' || !is_numeric($id)) {
        echo json_encode(['success' => false, 'error' => 'Invalid or missing ID']);
        exit;
    }

    $id = (int) $id; // Cast to integer
    $success = pdc_techtalk::delete_techtalk($id);
    if ($success) {
        echo json_encode(['success' => true]);
        exit;
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to delete tech talk slot or slot not found']);
        exit;
    }
}

echo json_encode(['success' => false, 'error' => 'Invalid request method']);
exit;