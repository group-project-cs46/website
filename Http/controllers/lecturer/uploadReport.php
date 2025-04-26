<?php

use Models\Report;
use Models\LecturerVisit;

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

// Update lecturer_visits with the new report ID
LecturerVisit::updateReportId($lecturer_visit_id, $reportId);

// Redirect
redirect("/VisitViews?id={$lecturer_visit_id}");


