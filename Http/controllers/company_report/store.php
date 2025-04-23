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

    // Validate all 6 reports
    $reportsData = [];
    for ($i = 1; $i <= 6; $i++) {
        $reportKey = "report{$i}";
        if (!isset($_FILES[$reportKey]) || $_FILES[$reportKey]['error'] === UPLOAD_ERR_NO_FILE) {
            $errors[$reportKey] = "Report {$i} is required.";
            continue;
        }

        $form = Forms\ReportUpload::validate([
            'report' => $_FILES[$reportKey],
            'description' => "Report {$i}" // Automatically set description
        ]);

        $reportsData[$i] = [
            'file' => $_FILES[$reportKey],
            'description' => "Report {$i}"
        ];
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

    // Process file uploads
    $targetDir = base_path('storage/reports/');
    foreach ($reportsData as $i => $reportData) {
        $fileTmpPath = $reportData['file']['tmp_name'];
        $fileName = $reportData['file']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $newFileName = md5(time() . $fileName . $i) . '.' . $fileExtension;
        $targetFile = $targetDir . $newFileName;

        if (!move_uploaded_file($fileTmpPath, $targetFile)) {
            $errors["report{$i}"] = "Report {$i} has not been uploaded.";
        } else {
            companyReport::create(
                $companyId,
                $subjectId,
                $newFileName,
                $fileName,
                $reportData['description']
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

    redirect('/company/report?success=Reports uploaded successfully');
    exit();
}

// For GET requests, $reports is already fetched above
require base_path('views/company/report.view.php');