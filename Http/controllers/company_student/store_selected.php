<?php
use Core\App;
use Core\Database;
use Models\companyStudent;
use Models\Notification;

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

    // Check if the application exists and fetch student index number
    $application = $db->query('
        SELECT a.selected, a.student_id, a.ad_id, s.index_number
        FROM applications a
        JOIN students s ON a.student_id = s.id
        WHERE a.id = ?
    ', [$applicationId])->find();

    if (!$application) {
        echo json_encode(['success' => false, 'error' => 'Application not found']);
        exit;
    }

    // Check if the application is already selected
    if (filter_var($application['selected'], FILTER_VALIDATE_BOOLEAN)) {
        echo json_encode(['success' => false, 'error' => 'Application is already selected']);
        exit;
    }

    // Update the selected column to TRUE for THIS application only
    $db->query('
        UPDATE applications
        SET selected = TRUE
        WHERE id = ?
    ', [$applicationId]);

    // Fetch the company_id from the advertisements table
    $advertisement = $db->query("SELECT company_id FROM advertisements WHERE id = ?", [$application['ad_id']])->find();
    $company_id = $advertisement['company_id'] ?? null;

    if ($company_id) {
        // Fetch the company name from the users table
        $company = $db->query("SELECT name FROM users WHERE id = ?", [$company_id])->find();
        $companyName = $company['name'] ?? 'Unknown Company';

        // Send notification to the student
        Notification::create(
            $application['student_id'],
            'Application Selected',
            'You have been selected by ' . $companyName,
            null,
            date('Y-m-d H:i:s', strtotime('+1 day'))
        );

        // Fetch all PDC user IDs
        $pdc_users = $db->query("SELECT id FROM pdcs", [])->get();

        // Send notification to each PDC user
        foreach ($pdc_users as $pdc) {
            Notification::create(
                $pdc['id'],
                'Student Selected',
                'Student ' . $application['index_number'] . ' has been selected by ' . $companyName,
                null,
                date('Y-m-d H:i:s', strtotime('+1 day'))
            );
        }
    }

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => 'Server error: ' . $e->getMessage()]);
}