<?php

use Models\pdcRoles;

header('Content-Type: application/json'); // Set JSON response type

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $name = $_POST['name'] ?? null;
    $description = $_POST['description'] ?? ''; // Default to empty string if not provided

    if ($id && $name) { // Only check id and name
        $result = pdcRoles::edit_role($id, $name, $description);
        if ($result) {
            echo json_encode([
                'success' => true,
                'id' => $id,
                'name' => $name,
                'description' => $description, // corrected typo (was $time)
            ]);
            exit;
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to update Job Role']);
            exit;
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'ID and Name are required']);
        exit;
    }
}

// If not POST, fetch data for the view (GET request)
$job_role = pdcRoles::fetchAll();
view('PDC/Job_roles.view.php', [
    'job_role' => $job_role,
    'error' => null
]);
