<?php

use Core\App;
use Core\Database;
use Core\Session;
use Core\Validator;
use Models\Ad;
use Models\Application;


//dd($_POST);

$application_id = $_POST['id'];
$cv_id = $_POST['cv_id'];


$user_id = auth_user()['id'];

$application = Application::getById($application_id);

if ($application['student_id'] != $user_id) {
    header('Location: /students/applications');
    exit();
}

if ($application['selected'] || $application['failed']) {
    Session::flash('toast', 'You cannot update this application');
    redirect('/students/applications');
}

Application::updateCvId($application_id, $cv_id);


// header mean redirect
header('location: /students/applications');
die();