<?php

use Models\AddStudent;

$students = AddStudent::fetch_student();
$hired_students = AddStudent::fetch_hired_students();

view('PDC/ManageStudents.view.php', [
    'students' => $students,
    'hired_students' => $hired_students
]);
