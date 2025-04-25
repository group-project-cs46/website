<?php
use Core\Response;
use Models\companyStudent;
use Models\Notification;
use Core\App;
use Core\Database;

// Get the POST data
$applicationId = isset($_POST['application_id']) ? (int)$_POST['application_id'] : null;
$venue = isset($_POST['venue']) ? trim($_POST['venue']) : null;
$date = isset($_POST['date']) ? trim($_POST['date']) : null;
$fromTime = isset($_POST['from_time']) ? trim($_POST['from_time']) : null;
$toTime = isset($_POST['to_time']) ? trim($_POST['to_time']) : null;

if (!$applicationId || !$venue || !$date || !$fromTime || !$toTime) {
    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
    exit;
}

try {
    // Schedule the interview using the companyStudent model
    $interviewId = companyStudent::scheduleInterview($applicationId, $venue, $date, $fromTime, $toTime);

    if ($interviewId) {
        // Fetch the application details to get student and company info
        $db = App::resolve(Database::class);
        $application = $db->query("
            SELECT a.student_id, a.ad_id
            FROM applications a
            WHERE a.id = ?
        ", [$applicationId])->find();

        if ($application) {
            $student_id = $application['student_id'];
            $ad_id = $application['ad_id'];

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
                    'Interview Scheduled',
                    'Your interview has been scheduled by ' . $companyName . ' on ' . $date . ' from ' . $fromTime . ' to ' . $toTime,
                    null,
                    date('Y-m-d H:i:s', strtotime('+1 day'))
                );
            }
        }

        echo json_encode(['success' => true, 'interview_id' => $interviewId]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to schedule interview']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => 'An error occurred: ' . $e->getMessage()]);
}