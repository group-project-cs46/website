<?php

use Models\companyReport;
use Models\Notification;
use Http\Forms;
use Core\App;
use Core\Database;

// Initialize errors array
$errors = [];

// Always fetch reports initially
$userId = auth_user()['id'] ?? null;
if (!$userId) {
    error_log("Company ID not found in session");
    redirect('/company/report?error=Company ID not found');
    exit();
}
$reports = companyReport::findBySenderId($userId) ?? [];
error_log("User ID: $userId, Reports fetched: " . json_encode($reports));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate index number and get subject_id
    $indexNumber = $_POST['index_number'] ?? null;
    if (!$indexNumber) {
        $errors['index_number'] = "Student index number is required.";
    } else {
        $db = App::resolve(Database::class);
        // Check if the student exists and is selected by the company
        $student = $db->query(
            'SELECT s.id, s.index_number, a.selected, a.ad_id 
             FROM students s 
             JOIN applications a ON s.id = a.student_id 
             WHERE s.index_number = ? AND a.selected = TRUE AND a.ad_id IN (
                 SELECT id FROM advertisements WHERE company_id = ?
             )',
            [$indexNumber, $userId]
        )->find();

        if (!$student) {
            // Debug: Check if the student exists
            $studentExists = $db->query(
                'SELECT id FROM students WHERE index_number = ?',
                [$indexNumber]
            )->find();
            if (!$studentExists) {
                $errors['index_number'] = "Invalid student index number.";
            } else {
                // Student exists, check application details
                $application = $db->query(
                    'SELECT ad_id, selected FROM applications WHERE student_id = ? AND selected = TRUE',
                    [$studentExists['id']]
                )->find();
                if ($application) {
                    $adId = $application['ad_id'];
                    $adDetails = $db->query(
                        'SELECT company_id FROM advertisements WHERE id = ?',
                        [$adId]
                    )->find();
                    error_log("Student Index: $indexNumber, Ad ID: $adId, Ad Company ID: " . ($adDetails['company_id'] ?? 'Not found') . ", Logged-in Company ID: $userId");
                    $errors['index_number'] = "Student not selected by your company.";
                } else {
                    $errors['index_number'] = "Student not selected.";
                }
            }
        } else {
            $subjectId = $student['id'];
        }
    }

    // Validate description
    $description = $_POST['description'] ?? '';
    if (empty($description)) {
        $errors['description'] = "Description is required.";
    }

    // Validate the single report
    if (!isset($_FILES['report']) || $_FILES['report']['error'] === UPLOAD_ERR_NO_FILE) {
        $errors['report'] = "Report file is required.";
    } else {
        $form = Forms\ReportUpload::validate([
            'report' => $_FILES['report']
        ]);
    }

    // If there are validation errors, reload the view with errors
    if (!empty($errors)) {
        $reports = companyReport::findBySenderId($userId) ?? [];
        error_log("Validation errors, Reports fetched: " . json_encode($reports));
        require base_path('views/company/report.view.php');
        exit();
    }

    // Get company ID (already checked above)
    $companyId = $userId;

    // Fetch the company name from the users table
    $db = App::resolve(Database::class);
    $company = $db->query("SELECT name FROM users WHERE id = ?", [$companyId])->find();
    $companyName = $company['name'] ?? 'Unknown Company';

    // Process file upload
    $targetDir = base_path('storage/');
    $fileTmpPath = $_FILES['report']['tmp_name'];
    $fileName = $_FILES['report']['name'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
    $targetFile = $targetDir . $newFileName;

    if (!move_uploaded_file($fileTmpPath, $targetFile)) {
        $errors['report'] = "The report has not been uploaded.";
    } else {
        companyReport::create(
            $companyId,
            $subjectId,
            $newFileName,
            $fileName,
            $description
        );
        $pdc_users = $db->query("SELECT id FROM pdcs", [])->get();
        // Send a notification to each PDC user
        foreach ($pdc_users as $pdc) {
            Notification::create(
                $pdc['id'], // user_id (PDC user)
                'New Report Uploaded',
                'A new report for student ' . $indexNumber . ' has been uploaded by ' . $companyName,
                null, // Optional action URL to view reports
                date('Y-m-d H:i:s', strtotime('+1 day')) // Expires in 1 day
            );
        }
    }

    // If there were upload errors, reload the view
    if (!empty($errors)) {
        $reports = companyReport::findBySenderId($userId) ?? [];
        error_log("Upload errors, Reports fetched: " . json_encode($reports));
        require base_path('views/company/report.view.php');
        exit();
    }

    redirect('/company/report?success=Report uploaded successfully');
    exit();
}

// For GET requests, $reports is already fetched above
require base_path('views/company/report.view.php');