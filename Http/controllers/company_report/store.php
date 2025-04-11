<?php
use Models\storeReport;
use Core\Validator;

// Check if form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentName = $_POST['student_name'] ?? null;
    $indexNumber = $_POST['index_number'] ?? null;
    $studentEmail = $_POST['student_email'] ?? null;
    $companyId = auth_user()['company_id']; // Assuming the logged-in user has a company ID

    $reportFiles = [];

    // Handling file uploads
    for ($i = 1; $i <= 6; $i++) {
        if (isset($_FILES["report$i"]) && $_FILES["report$i"]['error'] == UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES["report$i"]['tmp_name'];
            $fileName = $_FILES["report$i"]['name'];
            $fileType = $_FILES["report$i"]['type'];

            // Validate file type
            if ($fileType !== "application/pdf") {
                header("Location: /company/report/form?error=Invalid file format (PDF only)");
                exit();
            }

            // Move file to uploads directory
            $destination = "uploads/reports/" . uniqid() . "-" . basename($fileName);
            move_uploaded_file($fileTmpPath, $destination);
            $reportFiles[] = $destination;
        } else {
            $reportFiles[] = null; // Store NULL for missing files
        }
    }

    // Store report details in database
    if (storeReport::create($companyId, $studentName, $indexNumber, $studentEmail, $reportFiles)) {
        header("Location: /company/report?success=Report submitted successfully");
        exit();
    } else {
        header("Location: /company/report/form?error=Failed to save report");
        exit();
    }
}
?>
