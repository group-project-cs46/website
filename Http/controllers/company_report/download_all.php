<?php
use Models\companyReport;

$index_number = $_GET['index_number'] ?? null;
$user_id = auth_user()['id'] ?? null;

if (!$index_number || !$user_id) {
    redirect('/company/report?error=Invalid request');
}

// Fetch the report for the student
$reports = companyReport::findByIndexNumber($index_number, $user_id);

if (empty($reports)) {
    redirect('/company/report?error=No report found for this student');
}

// Since there’s only one report, take the first one
$report = $reports[0];

$file_path = base_path('storage/reports/' . $report['filename']);
$original_name = $report['original_name'] ?: 'report_' . $index_number . '.pdf';

if (file_exists($file_path)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . $original_name . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file_path));
    readfile($file_path);
    exit;
} else {
    redirect('/company/report?error=File not found');
}