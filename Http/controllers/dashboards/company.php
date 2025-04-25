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

// Fetch applied students dynamically
$appliedStudents = CompanyDashboard::fetchAppliedStudents();

// Fetch the next tech talk and company visit for the current company
$nextTechTalk = CompanyDashboard::fetchNextTechTalk();
$nextCompanyVisit = CompanyDashboard::fetchNextCompanyVisit();

$data = [
    'appliedStudents' => $appliedStudents,
    'errorApplied' => empty($appliedStudents) ? 'No applied students found.' : null,
    'nextTechTalk' => $nextTechTalk,
    'nextCompanyVisit' => $nextCompanyVisit
];

// Pass the data to the view
view('dashboards/company.view.php', $data);