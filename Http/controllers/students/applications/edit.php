<?php

use Models\Ad;
use Models\Company;
use Models\Application;
use Models\Cv;

$id = $_GET['id'];

$application = Application::getById($id);

if($application['student_id'] != auth_user()['id']) {
    header('Location: /students/applications');
    exit();
}

$userCvs = Cv::findByUserId(auth_user()['id']);

view('students/applications/edit.view.php', [
    'heading' => 'Jobs',
    'application' => $application,
    'userCvs' => $userCvs
]);