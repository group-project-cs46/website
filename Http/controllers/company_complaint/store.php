<?php
use Core\Validator;
use Models\companyComplaint;
use Models\Notification;
use Core\App;
use Core\Database;

$complaintType = $_POST['complaint_type'] ?? null;
$subject = $_POST['subject'] ?? null;
$complaintDescription = $_POST['complaint_description'] ?? null;
$indexNo = $_POST['index_no'] ?? null; // Only for student complaints
$userId = auth_user()['id'];

try {
    if (!$complaintType || !$subject || !$complaintDescription) {
        throw new Exception("Missing required fields.");
    }

    // Call the model to store the complaint
    if (companyComplaint::create($complaintType, $subject, $complaintDescription, $userId, $indexNo)) {
        // Fetch the company name from the users table
        $db = App::resolve(Database::class);
        $company = $db->query("SELECT name FROM users WHERE id = ?", [$userId])->find();
        $companyName = $company['name'] ?? 'Unknown Company';

        // Fetch all PDC user IDs
        $pdc_users = $db->query("SELECT id FROM pdcs", [])->get();

        // Send a notification to each PDC user
        foreach ($pdc_users as $pdc) {
            Notification::create(
                $pdc['id'], // user_id (PDC user)
                'New Complaint Submitted',
                'A new ' . ($complaintType === 'system' ? 'system' : 'student') . ' complaint has been submitted by ' . $companyName,
                null, // No action URL as per previous pattern
                date('Y-m-d H:i:s', strtotime('+1 day')) // Expires in 1 day
            );
        }

        // If the complaint type is 'system', also send a notification to the admin (ID 1)
        if ($complaintType === 'system') {
            Notification::create(
                1, // Admin user ID
                'New System Complaint Submitted',
                'A new system complaint has been submitted by ' . $companyName,
                null, // No action URL
                date('Y-m-d H:i:s', strtotime('+1 day')) // Expires in 1 day
            );
        }

        // Redirect to the complaint form with a success message
        header('Location: /company/complaint?success=Complaint submitted successfully');
        exit();
    }
} catch (Exception $e) {
    // Redirect back to the form with the specific error message
    header('Location: /company/complaint?error=' . urlencode($e->getMessage()));
    exit();
}