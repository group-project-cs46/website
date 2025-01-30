<?php

use Models\Ad;
use Models\Company;
use Models\Application;

$user = auth_user();
$user_id = $user['id'];

$applications = Application::getByStudentIdWithDetails($user_id);

view('students/applications/index.view.php', [
    'heading' => 'Jobs',
    'applications' => $applications
]);