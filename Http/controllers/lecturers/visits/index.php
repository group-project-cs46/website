<?php

use Models\LecturerVisit;

$auth_user = auth_user();

$current_batch = \Models\Batch::currentBatch();

$lecturer_visits = LecturerVisit::getByLecturerIdOnlyApproved($auth_user['id']);

//dd($lecturer_visits);

view('/lecturers/visits/index.view.php', [
    'lecturer_visits' => $lecturer_visits
]);