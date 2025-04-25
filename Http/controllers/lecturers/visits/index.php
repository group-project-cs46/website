<?php

use Models\LecturerVisit;

$auth_user = auth_user();

$current_batch = \Models\Batch::currentBatch();

$lecturer_visits = LecturerVisit::getByLecturerId($auth_user['id'], $current_batch['id']);

//dd($lecturer_visits);

view('/lecturers/visits/index.view.php', [
    'lecturer_visits' => $lecturer_visits
]);