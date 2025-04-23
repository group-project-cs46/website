<?php

use Models\storeAd;

// Assuming a function or mechanism to get the current company_id (e.g., from session or auth)
function getCurrentCompanyId() {
    // Placeholder: Replace with actual logic to get company_id (e.g., from session or user data)
    return $_SESSION['company_id'] ?? 6; // Default to 6 as seen in the database for consistency
}

$job_role = $_POST['job_role'] ?? null;
$responsibilities = $_POST['responsibilities'] ?? null;
$qualifications_skills = $_POST['qualification_skills'] ?? null;
$vacancy_count = $_POST['vacancy_count'] ?? null;
$maxCVs = $_POST['maxCVs'] ?? null;
$deadline = $_POST['deadline'] ?? null;
$company_id = getCurrentCompanyId();

// Call the storeAd model to create the advertisement, passing the company_id
storeAd::create($job_role, $responsibilities, $qualifications_skills, $vacancy_count, $maxCVs, $deadline, $company_id);

// Redirect to the advertisements page
header('location: /company/advertisment');
die();