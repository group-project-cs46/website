<?php

use Core\Session;
use Models\TrainingSession;
use Models\TrainingSessionRegistration;

$training_session_id = $_POST['training_session_id'];
$training_session = TrainingSession::get_by_id($training_session_id);

$attendance_code = $_POST['attendance_code'];

$auth_user = auth_user();

//dd($training_session['attendance_code']);
//dd($attendance_code);

if ($training_session['attendance_code'] !== $attendance_code) {
     Session::flash('toast', 'Invalid attendance code.');
     redirect(urlBack());
}

TrainingSessionRegistration::markAttendance($auth_user['id'], $training_session_id);
Session::flash('toast', 'Attendance marked successfully.');

redirect(urlBack());