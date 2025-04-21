<?php

use Models\TrainingSession;

$training_session_id = $_GET['id'];

$training_session = TrainingSession::get_by_id($training_session_id);

view('students/training_sessions/show.view.php', [
    'training_session' => $training_session,
]);