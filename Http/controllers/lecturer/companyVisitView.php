<?php

// use Models\LecturerVisit;
// use Models\Student;

// $lecturer_visit_id = $_GET['id'] ?? null;
// if (!$lecturer_visit_id) {
//     abort(); // or redirect('/lecturers/company-visits');
// }
// // dd($lecturer_visit_id);
// $lecturer_visit = LecturerVisit::getById($lecturer_visit_id);
// // dd(value: $lecturer_visit);
// $students_in_company = Student::getSelectedForCompany($lecturer_visit['company_id']);


// // dd($students_in_company);

// view('/lecturer/companyVisitView.view.php', [
//     'lecturer_visit' => $lecturer_visit,
//     'students_in_company' => $students_in_company
// ]);



use Models\LecturerVisit;

$auth_user = auth_user(); // get logged-in user
// dd($auth_user);
// Get all company visits for the current lecturer
$lecturer_visits = LecturerVisit::getByLecturerId($auth_user["id"]);
dd($lecturer_visits);
view('/lecturer/companyVisitView.view.php', [
    'lecturer_visits' => $lecturer_visits
]);

