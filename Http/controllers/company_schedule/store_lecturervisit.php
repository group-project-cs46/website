<?php

namespace Controllers;

use Models\CompanyLecturerVisit;
use Models\Notification;
use Core\App;
use Core\Database;

header('Content-Type: application/json');

// Handle approve action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'approve') {
    $visitId = $_POST['visit_id'] ?? null;

    if (empty($visitId)) {
        echo json_encode(['success' => false, 'error' => 'Invalid visit ID']);
        exit();
    }

    try {
        CompanyLecturerVisit::updateStatus($visitId, true);

        // Fetch visit details to get company_id, lecturer_id, date, and time for notification
        $db = App::resolve(Database::class);
        $visit = $db->query("
            SELECT lv.company_id, lv.lecturer_id, lv.date, lv.time
            FROM lecturer_visits lv
            WHERE lv.id = ?
        ", [$visitId])->find();

        if ($visit) {
            $company_id = $visit['company_id'];
            $lecturer_id = $visit['lecturer_id'];
            $date = $visit['date'];
            $time = $visit['time'];

            // Fetch the company name from the users table
            $company = $db->query("SELECT name FROM users WHERE id = ?", [$company_id])->find();
            $companyName = $company['name'] ?? 'Unknown Company';

            // Fetch the lecturer's name and email from the users table
            $lecturer = $db->query("SELECT name, email FROM users WHERE id = ?", [$lecturer_id])->find();
            $lecturerName = $lecturer['name'] ?? 'Unknown Lecturer';
            $lecturerEmail = $lecturer['email'] ?? 'Unknown Email';

            // Fetch all PDC user IDs
            $pdc_users = $db->query("SELECT id FROM pdcs", [])->get();

            // Send a notification to each PDC user
            foreach ($pdc_users as $pdc) {
                Notification::create(
                    $pdc['id'], // user_id (PDC user)
                    'Lecturer Visit Approved',
                    "A lecturer visit by $lecturerName ($lecturerEmail) has been approved by $companyName on $date at $time",
                    null, // No action URL as per previous pattern
                    date('Y-m-d H:i:s', strtotime('+1 day')) // Expires in 1 day
                );
            }
        }
        // above notification
        echo json_encode(['success' => true]);
        exit();
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => 'Failed to approve visit']);
        exit();
    }
}

echo json_encode(['success' => false, 'error' => 'Invalid request']);
exit();
