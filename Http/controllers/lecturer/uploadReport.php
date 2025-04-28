<?php

use Models\Report;
use Models\LecturerVisit;

// Check if a file was uploaded
if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] == 0) {
    $pdf = $_FILES['pdf'];

    // Directory to save PDF
    $uploadDir = base_path('storage/reports');
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Generate unique filename
    $uniqueFilename = uniqid('report_', true) . '.pdf';
    $destination = $uploadDir . '/' . $uniqueFilename;

    // Move uploaded file
    move_uploaded_file($pdf['tmp_name'], $destination);

    // Insert into reports table
    $reportId = Report::create(
        $lecturer_id,             // sender_id
        $company_id,              // subject_id
        $uniqueFilename,          // filename
        $pdf['name'],             // original name
        'Lecturer Company Visit'  // description
    );

    // 🟰 IMPORTANT CHANGE: Update lecturer_visits with the new report ID
    LecturerVisit::updateReportId($lecturer_visit_id, $reportId);  // Correct method name

    // Redirect back to the visit view
    redirect("/VisitViews?id={$lecturer_visit_id}");
} else {
    // If file upload failed
    $errors['pdf'] = 'Failed to upload file.';
    // Optionally re-render the form with errors
}
