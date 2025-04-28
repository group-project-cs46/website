<?php
use Models\pdc_studentreport;

$report_id = $_GET['id'] ?? null;

if (!$report_id) {
    redirect('/company/report?error=Invalid request');
}

// Fetch the report by ID
$report = pdc_studentreport::findById($report_id);

if (!$report) {
    redirect('/company/report?error=Report not found');
}

// Create a temporary ZIP file
$zip = new ZipArchive();
$zip_filename = tempnam(sys_get_temp_dir(), 'report_') . '.zip';

if ($zip->open($zip_filename, ZipArchive::CREATE) !== true) {
    redirect('/company/report?error=Failed to create ZIP file');
}

$file_path = base_path('storage/' . $report['filename']);
$original_name = $report['original_name'] ?: 'report_' . $report['description'] . '.pdf';

if (file_exists($file_path)) {
    $zip->addFile($file_path, $original_name);
}

//dd($zip_filename);

$zip->close();


// Send ZIP file as download
header('Content-Type: application/zip');
header('Content-Disposition: attachment; filename="report_' . $report_id . '.zip"');
header('Content-Length: ' . filesize($zip_filename));
readfile($zip_filename);


// Delete temp ZIP file
unlink($zip_filename);
exit;
