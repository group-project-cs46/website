<?php

use Models\Report;
use Models\LecturerVisit;

// Handle POST only
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

// Validate file
if ($fileType !== 'application/pdf') {
    $_SESSION['errors']['pdf'] = 'Only PDF files are allowed.';
    redirectBack();
}


// Validate file type (safety)
$fileType = mime_content_type($_FILES['pdf']['tmp_name']);
if ($fileType !== 'application/pdf') {
    $_SESSION['errors']['pdf'] = 'Only PDF files are allowed.';
    redirectBack();
}

// Validate lecturer_visit_id
if (!isset($_POST['lecturer_visit_id'])) {
    exit('Invalid lecturer visit');
}

$lecturerVisitId = $_POST['lecturer_visit_id'];
// dd($lecturerVisitId);
// Move uploaded file
$originalName = $_FILES['pdf']['name'];
$filename = uniqid() . '-' . $originalName;
$targetPath = base_path('storage/reports/' . $filename);

// Make sure directory exists
if (!is_dir(dirname($targetPath))) {
    mkdir(dirname($targetPath), 0777, true);
}

move_uploaded_file($_FILES['pdf']['tmp_name'], $targetPath);

// Insert into `reports` table
$sender_id = auth_user()->user('id'); // Your logged-in user's ID
$subject_id = $lecturerVisitId;   // Lecturer Visit ID
$description = 'Lecturer Visit Report';
// dd($sender_id);
$reportId = Report::create($sender_id, $subject_id, $filename, $originalName, $description);

// Update `lecturer_visits` table
LecturerVisit::updateReportId($lecturerVisitId, $reportId);

// Redirect after success
redirect('/VisitView' . $lecturerVisitId);
