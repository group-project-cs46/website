<?php

use Models\LecturerVisit;
use Models\Student;
use Models\LecturerVisitReport;

// Get session data
$lecturer_id = $_SESSION['user']['id'] ?? null;
$lecturer_visit_id = $_POST['lecturer_visit_id'] ?? null;
$company_id = $_POST['company_id'] ?? null;
$pdf = $_FILES['pdf'] ?? null;

$errors = [];

// Validate PDF
if (!$pdf || $pdf['error'] !== UPLOAD_ERR_OK || strtolower(pathinfo($pdf['name'], PATHINFO_EXTENSION)) !== 'pdf'
) {
    $errors['pdf'] = 'Please upload a valid PDF file.';
}

// Validate required IDs
if (!$lecturer_visit_id || !$lecturer_id || !$company_id) {
    $errors['form'] = 'Missing required data.';
}

// Fetch visit and student data regardless of success/failure to refill the view
$lecturer_visit = LecturerVisit::getById($lecturer_visit_id);
$students_in_company = Student::getSelectedForCompany($company_id);

if (!empty($errors)) {
    return view('lecturers/visits/companyVisitView', [
        'errors' => $errors,
        'lecturer_visit' => $lecturer_visit,
        'students_in_company' => $students_in_company
    ]);
}

try {
    LecturerVisitReport::upload($lecturer_visit_id, $lecturer_id, $company_id, $pdf);
    redirect("/lecturers/visits/view?id={$lecturer_visit_id}");

} catch (\Exception $e) {
    $errors['upload'] = $e->getMessage();

    return view('lecturers/visits/companyVisitView', [
        'errors' => $errors,
        'lecturer_visit' => $lecturer_visit,
        'students_in_company' => $students_in_company
    ]);
}

