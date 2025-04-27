<?php

use Models\Report;
use Models\LecturerVisit;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];

    // Validate PDF
    if (!isset($_FILES['pdf']) || $_FILES['pdf']['error'] !== UPLOAD_ERR_OK) {
        $errors['pdf'] = 'Failed to upload file.';
    } else {
        $fileTmpPath = $_FILES['pdf']['tmp_name'];
        $fileName = $_FILES['pdf']['name'];
        $fileSize = $_FILES['pdf']['size'];
        $fileType = $_FILES['pdf']['type'];

        $allowedTypes = ['application/pdf'];
        if (!in_array($fileType, $allowedTypes)) {
            $errors['pdf'] = 'Only PDF files are allowed.';
        }
    }

    if (empty($errors)) {
        // Move the file to a permanent location
        $uploadDir = base_path('storage/reports/'); // make sure this folder exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $newFileName = uniqid() . '_' . $fileName;
        move_uploaded_file($fileTmpPath, $uploadDir . $newFileName);

        // Create a Report entry
        $sender_id = auth()->id; // or however you get the current logged in lecturer's id
        $subject_id = $_POST['company_id']; // Assuming subject_id means company id
        $description = "Lecturer visit report"; // or make it dynamic if you want
        $reportId = Report::create($sender_id, $subject_id, $newFileName, $fileName, $description);

        // Attach report to LecturerVisit
        $lecturerVisitId = $_POST['lecturer_visit_id'];
        LecturerVisit::updateReportId($lecturerVisitId, $reportId);

        // Redirect back or show success
        header('Location: /lecturervisitview?id=' . $lecturerVisitId);
        exit();
    } else {
        // Store errors and redirect back or render view with $errors
    }
}
