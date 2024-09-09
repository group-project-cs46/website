<?php

$user = \Models\User::find($_SESSION['user']['email']);

$cv = \Models\Cv::findByUserId($user['id']);


view('/account.view.php', [
    'user' => $user,
    'errors' => $_SESSION['_flash']['errors'] ?? [],
    'cv' => $cv
]);