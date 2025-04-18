<?php
use Core\App;
use Core\Database;

$userId = auth_user()['id'];

$db = App::resolve(Database::class);

try {
    // Fetch complaints for the current user (complainant)
    $complaints = $db->query(
        'SELECT c.*, s.index_number 
         FROM complaints c 
         LEFT JOIN students s ON c.accused_id = s.id 
         WHERE c.complainant_id = ?',
        [$userId]
    )->get();

    // Return the complaints as JSON
    echo json_encode([
        'success' => true,
        'complaints' => $complaints
    ]);
} catch (Exception $e) {
    error_log('Error fetching complaints: ' . $e->getMessage());
    echo json_encode([
        'success' => false,
        'error' => 'Failed to fetch complaints'
    ]);
}