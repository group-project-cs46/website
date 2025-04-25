<?php
use Models\companyReport;

$report_id = $_GET['id'] ?? null;

if (!$report_id) {
    redirect('/company/report?error=Report ID not found');
}

$report = companyReport::find($report_id);

if (!$report) {
    redirect('/company/report?error=Report not found');
}

if ($report['sender_id'] != auth_user()['id']) {
    redirect('/company/report?error=Unauthorized access');
}

$filePath = base_path('storage/reports/' . $report['filename']);
$originalName = $report['original_name'] ?: 'report.pdf';

if (file_exists($filePath)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . $originalName . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filePath));
    readfile($filePath);
    exit;
} else {
    redirect('/company/report?error=File not found');
}