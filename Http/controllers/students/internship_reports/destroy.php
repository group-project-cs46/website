<?php

use Core\Session;
use Models\Report;


//dd($_POST);
$report_id = $_POST['id'];
$report = Report::findById($report_id);




$targetDir = base_path('storage/');
$filePath = $targetDir . $report['filename'];

// Check if the file exists and delete it
if (file_exists($filePath)) {
    unlink($filePath);
}

// Delete the Report record from the database
Report::delete($report_id);


redirect('/students/internship_reports');