<?php

use Core\App;
use Core\Database;
use Core\Session;
use Core\Validator;
use Models\Ad;
use Models\Application;
<<<<<<< HEAD
=======
use Models\Settings;
>>>>>>> 8b4d7493ee0f8e085c8141bffdabd5fb387be66c


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



$user = auth_user();
$user_id = $user['id'];

$existing_application = Application::findByStudentIdAndAdId($user_id, $ad_id);

if ($existing_application) {
    Session::flash('toast', 'You have already applied for this job');
    redirect('/students/advertisements');
}

$other_applications = Application::getByStudentId($user_id);
<<<<<<< HEAD

if (count($other_applications) >= 5) {
=======
$application_limit = Settings::getValueByKey('application_limit_per_student');

if (count($other_applications) >= $application_limit) {
>>>>>>> 8b4d7493ee0f8e085c8141bffdabd5fb387be66c
    Session::flash('toast', 'No more than 5 applications allowed');
    redirect('/students/advertisements');
}



Application::create($user_id, $cv_id, $ad_id);


redirect('/students/applications');