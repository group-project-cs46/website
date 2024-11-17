<?php

$user = \Models\User::find($_SESSION['user']['email']);

$cvs = \Models\Cv::findByUserId($user['id']);


view('/account.view.php', [
    'user' => $user,
    'errors' => $_SESSION['_flash']['errors'] ?? [],
    'cvs' => $cvs
]);