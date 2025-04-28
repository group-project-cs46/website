<?php

use Core\Session;
use Core\Storage;
use Http\Forms\LecturerVisitReportStore;
use Models\LecturerVisit;
use Models\LecturerVisitLecturer;

//dd($_FILES['file']);

$lecturer_visit_id = $_POST['id'];

$lecturers = LecturerVisitLecturer::getByLecturerVisitId($lecturer_visit_id);

$lecturer_ids = array_map(
    function ($lecturer) {
        return $lecturer['lecturer_id'];
    },
    $lecturers
);

$auth_user = auth_user();

if (!in_array($auth_user['id'], $lecturer_ids)) {
    redirect('/');
}

$form  = LecturerVisitReportStore::validate($attributes = [
    'id' => $lecturer_visit_id,
    'pdf' => $_FILES['pdf'],
]);


$lecturer_visit = LecturerVisit::getByIdWithDetails($lecturer_visit_id);

if ($lecturer_visit['report_file_id']) {
    Storage::delete($lecturer_visit['report_file_id']);
}



$report_file_id = Storage::store($attributes['pdf'], true);
if (!$report_file_id) {
    Session::toast('Failed to upload the pdf.', 'error');
}
//dd($report_file_id);

LecturerVisit::updateReportId(
    $attributes['id'],
    $report_file_id
);

redirect(urlBack());