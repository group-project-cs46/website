<?php

use Core\Session;
use Models\LecturerVisit;

$lecturer_visit_id = $_POST['id'] ?? null;


$lecturer_visit = LecturerVisit::getByIdWithDetails($lecturer_visit_id);

if ($lecturer_visit['visited']) {
    LecturerVisit::updateVisitedById(0, $lecturer_visit_id);
} else {
    LecturerVisit::updateVisitedById(1, $lecturer_visit_id);
}

Session::toast('Changed Successfully', 'success');
redirect(urlBack());