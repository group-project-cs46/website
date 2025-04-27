<?php

use Models\LecturerVisit;
use Models\Student;

$lecturer_visit_id = $_GET['id'];

$lecturer_visit = LecturerVisit::getByIdWithDetails($lecturer_visit_id);

$students_in_company = Student::getSelectedForCompany($lecturer_visit['company_id']);

//dd($students_in_company);
//dd($lecturer_visit);

//dd(strtotime($lecturer_visit['date'] . ' ' . $lecturer_visit['time']) > time());

view('/lecturers/visits/show.view.php', [
    'errors' => \Core\Session::getFlash('errors', []),
    'lecturer_visit' => $lecturer_visit,
    'students_in_company' => $students_in_company
]);

