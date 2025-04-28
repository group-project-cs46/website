<?php
use Models\pdcRoles;
use Core\App;
use Core\Database;

header('Content-Type: application/json');

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Correctly fetch name and description
    $name = $_POST['name'] ?? null;
    $description = $_POST['description'] ?? ''; // allow empty description

    if (!$name) {
        echo json_encode(['success' => false, 'error' => 'Name is required']);
        exit;
    }

    // Call create_role correctly
    $success = pdcRoles::create_role($name, $description);
    
    if ($success) {
        $db = App::resolve(Database::class); // Resolve Database instance
        $id = $db->lastInsertId(); // Get the ID of the newly created record
        echo json_encode([
            'success' => true,
            'id' => $id,
            'name' => $name,
            'description' => $description,
        ]);
        exit;
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to create Job Role']);
        exit;
    }
}
