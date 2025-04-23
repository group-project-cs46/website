<?php

use Models\LecturerVisit;

$auth_user = auth_user();

$lecturer_visits = LecturerVisit::getByLecturerId($auth_user['id']);

view('/lecturers/visits/index.view.php', [
    'lecturer_visits' => $lecturer_visits
]);