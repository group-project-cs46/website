<?php

use Models\Ad;
use Models\Company;
use Models\Application;

$user_id = auth_user()['id'];

$cvs = \Models\Cv::findByUserId($user_id);

view('students/cvs/index.view.php', [
    'cvs' => $cvs,
    'errors' => $_SESSION['_flash']['errors'] ?? []
]);