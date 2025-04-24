<?php

use Models\Application;
use Models\Company;
use Models\Ad;
use Models\Interview;

$application_id = $_GET['id'];

//dd($application_id);

$application = Application::getById($application_id);
$ad = Ad::getById($application['ad_id']);
$company = Company::getById($ad['company_id']);
$interview = Interview::getById($application['interview_id']);


//dd($application);
//dd($interview);

if ($interview) {
    $interview_end_time = strtotime($interview['date'] . ' ' . $interview['end_time']);

    $is_complete = $interview_end_time < time();

    $interview['complete'] = $is_complete;

//    dd($is_complete);

    //dd($interview);

    //dd($is_complete);

    //dd(date('Y-m-d H:i:s', $interview_end_time));
}


view('students/applications/show.view.php', [
    'application' => $application,
    'company' => $company,
    'ad' => $ad,
    'interview' => $interview,
    'errors' => $_SESSION['_flash']['errors'] ?? [],
]);