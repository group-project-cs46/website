<?php

use Models\CompanyDashboard;

// Fetch applied students dynamically
$appliedStudents = CompanyDashboard::fetchAppliedStudents();

$data = [
    'appliedStudents' => $appliedStudents,
    'errorApplied' => empty($appliedStudents) ? 'No applied students found.' : null
];

// Pass the data to the view
view('dashboards/company.view.php', $data);