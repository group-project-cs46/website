<?php
// Http/controllers/PDC/downloadlecturerreport.php

use Models\pdcCompanyvisit;

$visit_id = $_GET['visit_id'] ?? null;

if (!$visit_id) {
    redirect('/PDC/schedule?error=Invalid request');
}

// Fetch the visit by ID
$visits = pdcCompanyvisit::fetchAll();
$visit = null;
foreach ($visits as $v) {
    if ($v['visit_id'] == $visit_id) {
        $visit = $v;
        break;
    }
}

if (!$visit || !$visit['report_file_id']) {
    redirect('/PDC/schedule?error=Report not found');
}

// Fetch the report file details from the reports table
$report = [
    'filename' => $visit['filename'],
    'original_name' => $visit['original_name'] ?: 'lecturer_report_' . $visit['visit_id'] . '.pdf'
];

// Create a temporary ZIP file
$zip = new ZipArchive();
$zip_filename = tempnam(sys_get_temp_dir(), 'lecturer_report_') . '.zip';

if ($zip->open($zip_filename, ZipArchive::CREATE) !== true) {
    redirect('/PDC/schedule?error=Failed to create ZIP file');
}

$file_path = base_path('storage/reports/' . $report['filename']);
$original_name = $report['original_name'];

if (file_exists($file_path)) {
    $zip->addFile($file_path, $original_name);
}

$zip->close();

// Send ZIP file as download
header('Content-Type: application/zip');
header('Content-Disposition: attachment; filename="lecturer_report_' . $visit_id . '.zip"');
header('Content-Length: ' . filesize($zip_filename));
readfile($zip_filename);

// Delete temp ZIP file
unlink($zip_filename);
exit;