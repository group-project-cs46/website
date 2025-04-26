<?php

use Models\storeAd;

// Assuming a function or mechanism to get the current company_id (e.g., from session or auth)
$auth_user = auth_user();

//$job_role = $_POST['job_role'] ?? null;
$internship_role_id = $_POST['internship_role_id'] ?? null;
$responsibilities = $_POST['responsibilities'] ?? null;
$qualifications_skills = $_POST['qualification_skills'] ?? null;
$vacancy_count = $_POST['vacancy_count'] ?? null;
$maxCVs = $_POST['maxCVs'] ?? null;
$deadline = $_POST['deadline'] ?? null;
$company_id = $auth_user['id'];

// Call the storeAd model to create the advertisement, passing the company_id
storeAd::create($responsibilities, $qualifications_skills, $vacancy_count, $maxCVs, $deadline, $company_id, $internship_role_id);

// Redirect to the advertisements page
header('location: /company/advertisment');
die();