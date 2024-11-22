<?php

use Core\App;
use Core\Database;
use Core\Validator;
use Models\Ad;
use Models\Application;


// dd($_POST);

$ad_id = $_POST['ad_id'];
$cv_id = $_POST['cv_id'];

$user = \Models\User::find($_SESSION['user']['email']);
$user_id = $user['id'];

Application::create($user_id, $cv_id, $ad_id);


// header mean redirect
header('location: /advertisments');
die();