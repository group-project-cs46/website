<?php

use Models\Ad;
use Models\Company;
use Models\Application;
use Models\Cv;

$user = auth_user();
$user_id = $user['id'];

$applications = Application::getByStudentIdWithDetails($user_id);

$userCvs = Cv::findByUserId(auth_user()['id']);


//dd($applications);

view('students/applications/index.view.php', [
    'heading' => 'Jobs',
    'applications' => $applications,
    'userCvs' => $userCvs
]);