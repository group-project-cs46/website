<?php

use Models\CompanyDashboard;

// Assume the current company's ID is available (e.g., from session)
$currentCompanyId = 6; // Changed to 6 to match the techtalks table data

// Fetch applied students dynamically
$appliedStudents = CompanyDashboard::fetchAppliedStudents();

// Fetch the next tech talk and company visit for the current company
$nextTechTalk = CompanyDashboard::fetchNextTechTalk($currentCompanyId);
$nextCompanyVisit = CompanyDashboard::fetchNextCompanyVisit($currentCompanyId);

$data = [
    'appliedStudents' => $appliedStudents,
    'errorApplied' => empty($appliedStudents) ? 'No applied students found.' : null,
    'nextTechTalk' => $nextTechTalk,
    'nextCompanyVisit' => $nextCompanyVisit
];

// Pass the data to the view
view('dashboards/company.view.php', $data);