<?php


use Models\LecturerVisit;
use Models\AddPdc; 
use Models\AddLecturer;
use Models\pdcDashboard;

$auth_user = auth_user();

$current_batch = \Models\Batch::currentBatch();

$lecturer_visits = LecturerVisit::getByLecturerIdOnlyApproved($auth_user['id']);

$pdcCount = AddPdc::get_total_count(); 
$lecCount = AddLecturer::get_total_count();
$registeredStudents = pdcDashboard::countRegisteredstudents(); 
$registeredCompanies = pdcDashboard::countRegisteredcompanies();


//dd($lecturer_visits);

view('dashboards/lecturer.view.php', [
    'lecturer_visits' => $lecturer_visits,
    'PDC_COUNT' => $pdcCount,
    'LEC_COUNT' => $lecCount,
    'STU_COUNT' => $lecCount,
    'COM_COUNT' => $lecCount
]);
