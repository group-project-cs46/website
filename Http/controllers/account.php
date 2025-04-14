<?php

use Models\Cv;
use Models\Student;
use Models\User;
use Core\Session;



$user_id = auth_user()['id'];
$user = User::findByIdWithRoleData($user_id);

//dd($user);


view('/account.view.php', [
    'user' => $user,
    'errors' => Session::getFlash('errors', []),
    'photo' => getUserProfilePhotoUrl($user)
]);