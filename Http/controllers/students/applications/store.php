<?php

use Core\App;
use Core\Database;
use Core\Session;
use Core\Validator;
use Models\Ad;
use Models\Application;


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

if (count($other_applications) >= 5) {
    Session::flash('toast', 'No more than 5 applications allowed');
    redirect('/students/advertisements');
}



Application::create($user_id, $cv_id, $ad_id);


redirect('/students/applications');