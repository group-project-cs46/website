<?php

use Models\editAd;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $id = $_POST['id'];
        $job_role = $_POST['job_role'] ?? null;
        $responsibilities = $_POST['responsibilities'] ?? null;
        $qualifications_skills = $_POST['qualifications_skills'] ?? null;
        $vacancy_count = $_POST['vacancy_count'] ?? null;
        $maxCVs = $_POST['max_cvs'] ?? null;
        $deadline = $_POST['deadline'] ?? null;

        editAd::edit($job_role, $responsibilities, $qualifications_skills, $vacancy_count, $maxCVs, $deadline, $id);

        header('Location: /company/advertisment');
        exit();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}