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

$user = \Models\User::findByEmail($_SESSION['user']['email']);
$user_id = $user['id'];

$existing_application = Application::findByStudentIdAndAdId($user_id, $ad_id);

if ($existing_application) {
    Session::flash('toast', 'You have already applied for this job');
    redirect('/advertisements');
}

Application::create($user_id, $cv_id, $ad_id);


// header mean redirect
header('location: /students/applications');
die();