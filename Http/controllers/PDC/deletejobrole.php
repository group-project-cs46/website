<?php
use Models\pdcRoles;
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
    $success = pdcRoles::delete_role($id);
    if ($success) {
        echo json_encode(['success' => true]);
        exit;
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to delete job role or not found']);
        exit;
    }
}

echo json_encode(['success' => false, 'error' => 'Invalid request method']);
exit;