<?php

use Core\App;
use Core\Database;
use Core\Session;
use Core\Validator;
use Http\Forms\ApplicationStore;
use Models\Ad;
use Models\Application;
use Models\Batch;
use Models\Notification;
use Models\Settings;


// dd($_POST);

$ad_id = $_POST['ad_id'];
$cv_id = $_POST['cv_id'];

$form = ApplicationStore::validate($attributes = [
    'ad_id' => $ad_id,
    'cv_id' => $cv_id,
]);

$user = auth_user();
$user_id = $user['id'];

$already_selected_companies = Application::selectedCompanyByStudentId($user_id);
if ($already_selected_companies) {
    Session::flash('toast', 'You have already been selected by a company');
    redirect(urlBack());
}

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

$currentBatch = Batch::currentBatch();
if ($currentBatch['id'] !== $ad['batch_id']) {
    Session::flash('toast', 'This ad is not for your batch');
    redirect('/students/advertisements');
}

$existing_application = Application::findByStudentIdAndAdId($user_id, $ad_id);

if ($existing_application) {
    $form->error('cv_id', 'You have already applied for this job')->throw();
    //    Session::flash('toast', 'You have already applied for this job');
    //    redirect('/students/advertisements');
}

$other_applications = Application::getByStudentId($user_id);
$application_limit = Settings::getValueByKey('application_limit_per_student');

if (count($other_applications) >= $application_limit) {
    Session::flash('toast', 'No more than 5 applications allowed');
    redirect('/students/advertisements');
}



Application::create($user_id, $cv_id, $ad_id);
Notification::create(
    $ad['company_id'],
    'New application',
    'You have a new application for the job ' . $ad['internship_role'] . ' from ' . $user['name']
);

redirect('/students/applications');