<?php
use Core\Validator;
use Models\companyComplaint;

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
        // Redirect to the complaint form with a success message
        header('Location: /company/complaint?success=Complaint submitted successfully');
        exit();
    }
} catch (Exception $e) {
    // Redirect back to the form with the specific error message
    header('Location: /company/complaint?error=' . urlencode($e->getMessage()));
    exit();
}