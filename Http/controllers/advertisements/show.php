<?php

use Models\Ad;

$ad = Ad::findWithCompany($_GET['id']);

$user = \Models\User::findByEmail($_SESSION['user']['email']);

$userCvs = \Models\Cv::findByUserId($user['id']);

// dd($userCvs);

// dd($ad);


view('advertisements/show.view.php', [
    'heading' => 'Apply',
    'ad' => $ad,
    'userCvs' => $userCvs
]);