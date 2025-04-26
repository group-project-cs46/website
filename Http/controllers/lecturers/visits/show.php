<?php

use Models\LecturerVisit;
use Models\Student;

$lecturer_visit_id = $_GET['id'];

$lecturer_visit = LecturerVisit::getById($lecturer_visit_id);

$students_in_company = Student::getSelectedForCompany($lecturer_visit['company_id']);

//dd($students_in_company);

view('/lecturers/visits/show.view.php', [
    'lecturer_visit' => $lecturer_visit,
    'students_in_company' => $students_in_company
]);

