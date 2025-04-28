<?php

use Models\LecturerVisit;
use Models\Student;

$lecturer_visit_id = $_GET['id'] ?? null;
if (!$lecturer_visit_id) {
    abort(); // or redirect('/lecturers/company-visits');
}
// dd($lecturer_visit_id);
$lecturer_visit = LecturerVisit::getById($lecturer_visit_id);
// dd($lecturer_visit);
view('lecturer\rejectReson.view.php', [
    'lecturer_visits' => $lecturer_visits
]);

// view('lecturer\rejectReson.view.php', attributes: []);