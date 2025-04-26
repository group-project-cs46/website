<?php

use Models\CompanyDashboard;

// Get the authenticated user (assuming this function returns the logged-in user's details)
$auth_user = auth_user();

// Ensure the user is authenticated and has a company_id
if (!$auth_user || !isset($auth_user['id'])) {
    // Redirect to login if not authenticated
    header('Location: /login');
    exit;
}

$currentCompanyId = $auth_user['id'];

// Fetch selected students dynamically
$selectedStudents = CompanyDashboard::fetchSelectedStudents();

// Fetch the next tech talk and company visit for the current company
$nextTechTalk = CompanyDashboard::fetchNextTechTalk();
$nextCompanyVisit = CompanyDashboard::fetchNextCompanyVisit();

$data = [
    'selectedStudents' => $selectedStudents,
    'errorSelected' => empty($selectedStudents) ? 'No selected students found.' : null,
    'nextTechTalk' => $nextTechTalk,
    'nextCompanyVisit' => $nextCompanyVisit
];

// Pass the data to the view
view('dashboards/company.view.php', $data);