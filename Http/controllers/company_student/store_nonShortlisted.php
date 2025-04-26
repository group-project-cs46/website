<?php
use Models\companyStudent;
use Models\Notification;
use Core\App;
use Core\Database;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the raw POST data
    $json = file_get_contents('php://input');
    
    // Decode the JSON data
    $data = json_decode($json, true);
    
    // Extract the search parameters
    $application_id = isset($data['application_id']) ? $data['application_id'] : '';
    
    if (companyStudent::nonShortedlistStudent($application_id)) {
        // Fetch the application details to get student and company info
        $db = App::resolve(Database::class);
        $application = $db->query("
            SELECT a.student_id, a.ad_id, s.index_number
            FROM applications a
            JOIN students s ON a.student_id = s.id
            WHERE a.id = ?
        ", [$application_id])->find();

        if ($application) {
            $student_id = $application['student_id'];
            $ad_id = $application['ad_id'];
            $index_number = $application['index_number'];

            // Fetch the company_id from the advertisements table
            $advertisement = $db->query("SELECT company_id FROM advertisements WHERE id = ?", [$ad_id])->find();
            $company_id = $advertisement['company_id'] ?? null;

            if ($company_id) {
                // Fetch the company name from the users table
                $company = $db->query("SELECT name FROM users WHERE id = ?", [$company_id])->find();
                $companyName = $company['name'] ?? 'Unknown Company';

                // Send notification to the student
                Notification::create(
                    $student_id,
                    'Application Rejected',
                    'You have been rejected by ' . $companyName,
                    null,
                    date('Y-m-d H:i:s', strtotime('+1 day'))
                );

                // Fetch all PDC user IDs
                $pdc_users = $db->query("SELECT id FROM pdcs", [])->get();

                // Send notification to each PDC user
                foreach ($pdc_users as $pdc) {
                    Notification::create(
                        $pdc['id'],
                        'Student Application Rejected',
                        'Student ' . $index_number . ' has been rejected by ' . $companyName,
                        null,
                        date('Y-m-d H:i:s', strtotime('+1 day'))
                    );
                }
            }
        }

        // Return results as JSON
        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
    } else {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'error' => 'Failed to reject student']);
    }
} else {
    // Not a POST request
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
}