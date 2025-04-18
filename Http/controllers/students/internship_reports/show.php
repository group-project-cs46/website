<?php

use Models\Report;
use Models\User;

$report_id = $_GET['id'];

$report = Report::findById($report_id);

if ($report['sender_id'] != auth_user()['id']) {
    redirect('/students/internship_reports');
}

if ($report) {
    $filePath = base_path('storage/' . $report['filename']);
    $originalName = $report['original_name'];

    if (file_exists($filePath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $originalName . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit;
    } else {
        dd('file not found');
        // Handle the error, e.g., file not found
        // redirect('/account');
    }
} else {
    dd('Report not found');
    // Handle the error, e.g., CV not found
    // redirect('/account');
}