<?php

use Core\Session;
use Models\TrainingSession;
use Models\TrainingSessionRegistration;

$training_session_id = $_GET['id'];

$auth_user = auth_user();

$training_session = TrainingSession::get_by_id($training_session_id);

$already_registered = TrainingSessionRegistration::getByUserIdAndTrainingSessionId($auth_user['id'], $training_session_id);

if ($already_registered) {
    Session::flash('toast', 'You have already registered for this training session.');
    redirect(urlBack());
}

TrainingSessionRegistration::create($training_session_id, auth_user()['id']);
Session::flash('toast', 'You have successfully registered for this training session.');

redirect(urlBack());