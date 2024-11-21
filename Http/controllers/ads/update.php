<?php

use Core\Validator;
use Models\updateAd;


$job_role = $_POST['job_role'] ?? null;
$responsibilities = $_POST['responsibilities'] ?? null;
$qualifications_skills = $_POST['qualification_skills'] ?? null;
$deadline = $_POST['deadline'] ?? null;
$maxCVs = $_POST['maxCVs'] ?? null;

updateAd::create( $job_role, $responsibilities, $qualifications_skills, $deadline, $maxCVs);



// header mean redirect
header('location: /company/advertisment');
die();