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

//dd($interview);


view('students/applications/show.view.php', [
    'application' => $application,
    'company' => $company,
    'ad' => $ad,
    'interview' => $interview,
]);