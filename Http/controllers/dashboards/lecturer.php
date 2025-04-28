<?php


use Models\LecturerVisit;

$auth_user = auth_user(); // get logged-in user
// dd($auth_user);
// Get all company visits for the current lecturer
$lecturer_visits = LecturerVisit::getByLecturerId($auth_user["id"]);
// dd($lecturer_visits);
view('dashboards/lecturer.view.php', [
    'lecturer_visits' => $lecturer_visits
]);

