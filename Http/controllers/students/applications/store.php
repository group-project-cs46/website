<?php

use Core\App;
use Core\Database;
use Core\Session;
use Core\Validator;
use Models\Ad;
use Models\Application;
use Models\Round;
use Models\Settings;


// dd($_POST);

$ad_id = $_POST['ad_id'];
$cv_id = $_POST['cv_id'];

$ad = Ad::find($ad_id);
$max_cvs = $ad['max_cvs'];

$other_applied = Application::getByAdId($ad_id);

if (count($other_applied) >= $max_cvs) {
    Session::flash('toast', 'No more than ' . $max_cvs . ' applications allowed');
    redirect('/students/advertisements');
}

if (strtotime($ad['deadline']) < time()) {
    Session::flash('toast', 'Deadline has passed for this job');
    redirect('/students/advertisements');
}

$currentRound = Round::currentRound();
if ($currentRound['id'] !== $ad['round_id']) {
    Session::flash('toast', 'This job is not available in this round');
    redirect('/students/advertisements');
}


$user = auth_user();
$user_id = $user['id'];

$existing_application = Application::findByStudentIdAndAdId($user_id, $ad_id);

if ($existing_application) {
    Session::flash('toast', 'You have already applied for this job');
    redirect('/students/advertisements');
}

$other_applications = Application::getByStudentId($user_id);
$application_limit = Settings::getValueByKey('application_limit_per_student');

if (count($other_applications) >= $application_limit) {
    Session::flash('toast', 'No more than 5 applications allowed');
    redirect('/students/advertisements');
}



Application::create($user_id, $cv_id, $ad_id);


redirect('/students/applications');