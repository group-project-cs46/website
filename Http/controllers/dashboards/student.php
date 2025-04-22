<?php

use Models\Application;
use Models\TrainingSession;
use Models\User;

$auth_user = auth_user();

$training_sessions = TrainingSession::get_all();

$user = User::findByIdWithRoleData($auth_user['id']);

$applications = Application::getByStudentIdWithDetails($auth_user['id']);
$applications = array_slice($applications, 0, 3);


//dd($applications);

view('dashboards/student.view.php', [
    'training_sessions' => $training_sessions,
    'user' => $user,
    'applications' => $applications,
]);
