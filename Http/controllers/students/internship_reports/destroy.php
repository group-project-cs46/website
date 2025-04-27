<?php

use Core\Session;
use Models\Report;


//dd($_POST);
$report_id = $_POST['id'];
$report = Report::findById($report_id);

$auth_user = auth_user();
if ($report['sender_id'] != $auth_user['id']) {
//    Session::toast('You are not authorized to delete this report.', 'warning');
    redirect('/students/internship_reports');
}




$targetDir = base_path('storage/');
$filePath = $targetDir . $report['filename'];

// Check if the file exists and delete it
if (file_exists($filePath)) {
    unlink($filePath);
}

// Delete the Report record from the database
Report::delete($report_id);


redirect('/students/internship_reports');