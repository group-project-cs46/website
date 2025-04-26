<?php

use Models\LecturerVisit;

$auth_user = auth_user();
// dd($auth_user);
$lecturer_visits = LecturerVisit::getById($auth_user["id"]);
dd($lecturer_visits);

view('/lecturer/companyVisit.view.php', [
    'lecturer_visits' => $lecturer_visits
]);
// use Models\LecturerVisit;
// use Models\Batch;

// $auth_user = auth_user();
// // dd($auth_user);
// // 🔧 Fix: Get current batch and pass batch ID
// $currentBatch = Batch::currentBatch();
// dd($currentBatch);
// $lecturer_visits = [];

// if ($currentBatch) {
//     $lecturer_visits = LecturerVisit::getByLecturerId($auth_user['id'], $currentBatch['id']);
// }

   
// view('/lecturer/companyVisit.view.php', [
//     'lecturer_visits' => $lecturer_visits
// ]);
