
<?php

use Models\AdminComplaint;
use Models\AddPdc; // <-- Add this line
use Models\AddLecturer; // <-- Add this line


$complaints = AdminComplaint::getAll();
$pdcCount = AddPdc::get_total_count(); // <-- Add this line
$lecCount = AddLecturer::get_total_count(); // <-- Add this line


view('dashboards/admin.view.php', [
    'COMPLAINT_DATA' => $complaints,
    'PDC_COUNT' => $pdcCount, // <-- Add this line
    'LEC_COUNT' => $lecCount // <-- Add this line

]);


