<?php

use Models\TrainingSession;
use Models\TrainingSessionRegistration;

$auth_user = auth_user();

$training_session_id = $_GET['id'];

$training_session = TrainingSession::get_by_id($training_session_id);

$already_registered = TrainingSessionRegistration::getByUserIdAndTrainingSessionId($auth_user['id'], $training_session_id);


view('students/training_sessions/show.view.php', [
    'training_session' => $training_session,
    'already_registered' => $already_registered
]);