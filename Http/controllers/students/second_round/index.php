<?php

use Models\Cv;
use Models\InternshipRole;
use Models\Round;
use Models\SecondRoundRole;

$currentRound = Round::currentRound();



$auth_user = auth_user();

$chosen_roles = SecondRoundRole::getAllByStudentId($auth_user['id']);

$userCvs = Cv::findByUserId($auth_user['id']);


$available_roles = InternshipRole::getAll();

//dd($available_roles);


//dd($chosen_roles);


//dd($job_roles);

view('students/second_round/index.view.php', [
    'errors' => $_SESSION['_flash']['errors'] ?? [],
    'currentRound' => $currentRound,
    'chosen_roles' => $chosen_roles,
    'userCvs' => $userCvs,
    'available_roles' => $available_roles,
]);