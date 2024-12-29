<?php

use Models\Cv;
use Models\Student;
use Models\User;



$user_id = auth_user()['id'];

$user = User::find($user_id);



$cvs = Cv::findByUserId($user_id);


view('/account.view.php', [
    'user' => $user,
    'errors' => $_SESSION['_flash']['errors'] ?? [],
    'cvs' => $cvs
]);