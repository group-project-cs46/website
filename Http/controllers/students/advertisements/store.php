<?php

use Core\App;
use Core\Database;
use Core\Validator;
use Models\Ad;


dd('why does student store advertisements');

$job_type = $_POST['job_type'] ?? null;
$job_role = $_POST['job_role'] ?? null;
$responsibilities = $_POST['responsibilities'] ?? null;
$qualifications_skills = $_POST['qualification_skills'] ?? null;
$maxCVs = $_POST['maxCVs'] ?? null;

Ad::create($job_type, $job_role, $responsibilities, $qualifications_skills, $maxCVs);


redirect('/company/advertisment');
