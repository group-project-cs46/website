<?php

use Models\Report;

$reports = Report::getBySenderId(auth_user()['id']);

//usort($reports, function($a, $b) {
//    return $b['description'] <=> $a['description'];
//});

view('students/internship_reports/index.view.php', [
    'errors' => $_SESSION['_flash']['errors'] ?? [],
    'reports' => $reports,
]);