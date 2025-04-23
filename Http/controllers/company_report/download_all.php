<?php
use Models\companyReport;

$index_number = $_GET['index_number'] ?? null;
$user_id = auth_user()['id'] ?? null;

if (!$index_number || !$user_id) {
    redirect('/company/report?error=Invalid request');
}

// Fetch all reports for the student
$reports = companyReport::findByIndexNumber($index_number, $user_id);

if (empty($reports)) {
    redirect('/company/report?error=No reports found for this student');
}

// Create a temporary ZIP file
$zip = new ZipArchive();
$zip_filename = tempnam(sys_get_temp_dir(), 'reports_') . '.zip';

if ($zip->open($zip_filename, ZipArchive::CREATE) !== true) {
    redirect('/company/report?error=Failed to create ZIP file');
}

// Add each report to the ZIP
foreach ($reports as $report) {
    $file_path = base_path('storage/reports/' . $report['filename']);
    $original_name = $report['original_name'] ?: 'report_' . $report['description'] . '.pdf';
    if (file_exists($file_path)) {
        $zip->addFile($file_path, $original_name);
    }
}

$zip->close();

// Download the ZIP file
header('Content-Type: application/zip');
header('Content-Disposition: attachment; filename="student_' . $index_number . '_reports.zip"');
header('Content-Length: ' . filesize($zip_filename));
readfile($zip_filename);

// Delete the temporary ZIP file
unlink($zip_filename);
exit;