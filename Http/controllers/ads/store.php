<?php

use Core\Validator;
use Models\storeAd;

$job_role = $_POST['job_role'] ?? null;
$responsibilities = $_POST['responsibilities'] ?? null;
$qualifications_skills = $_POST['qualification_skills'] ?? null;
$vacancy_count = $_POST['vacancy_count'] ?? null;
$maxCVs = $_POST['maxCVs'] ?? null;
$deadline = $_POST['deadline'] ?? null;


storeAd::create( $job_role, $responsibilities, $qualifications_skills, $vacancy_count, $maxCVs, $deadline);



// header mean redirect 
header('location: /company/advertisment');
die();




