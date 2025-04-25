<?php
use Models\companyReport;
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
        $subjectId = companyReport::getSubjectIdByIndexNumber($indexNumber);
        if (!$subjectId) {
            $errors['index_number'] = "Invalid student index number.";
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