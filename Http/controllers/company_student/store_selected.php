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

    // Check if the application exists and fetch the student_id
    $application = $db->query('
        SELECT student_id, selected 
        FROM applications 
        WHERE id = ?
    ', [$applicationId])->find();

    if (!$application) {
        echo json_encode(['success' => false, 'error' => 'Application not found']);
        exit;
    }

    // Check if the student is already selected for this application
    if (filter_var($application['selected'], FILTER_VALIDATE_BOOLEAN)) {
        echo json_encode(['success' => false, 'error' => 'Student is already selected']);
        exit;
    }

    $studentId = $application['student_id'];

    // Update the selected column to TRUE for ALL applications of this student
    $db->query('
        UPDATE applications
        SET selected = TRUE
        WHERE student_id = ?
    ', [$studentId]);

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => 'Server error: ' . $e->getMessage()]);
}
?>