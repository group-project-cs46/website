<?php
use Core\App;
use Core\Database;
use Models\companyStudent;

header('Content-Type: application/json');

try {
    // Get the request body
    $data = json_decode(file_get_contents('php://input'), true);

    // Validate application_id
    if (!isset($data['application_id']) || !is_numeric($data['application_id'])) {
        echo json_encode(['success' => false, 'error' => 'Invalid or missing application_id']);
        exit;
    }

    $applicationId = (int) $data['application_id'];
    $db = App::resolve(Database::class);

    // Check if the application exists and is not already selected
    $application = $db->query('
        SELECT selected 
        FROM applications 
        WHERE id = ?
    ', [$applicationId])->find();

    if (!$application) {
        echo json_encode(['success' => false, 'error' => 'Application not found']);
        exit;
    }

    if (filter_var($application['selected'], FILTER_VALIDATE_BOOLEAN)) {
        echo json_encode(['success' => false, 'error' => 'Student is already selected']);
        exit;
    }

    // Update the application to mark as selected
    $db->query('
        UPDATE applications
        SET selected = TRUE
        WHERE id = ?
    ', [$applicationId]);

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => 'Server error: ' . $e->getMessage()]);
}