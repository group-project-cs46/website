<?php

use Models\Cv;
use Models\Student;
use Models\User;
use Core\Session;



$user_id = auth_user()['id'];
$user = User::find($user_id);


view('/account.view.php', [
    'user' => $user,
    'errors' => Session::getFlash('errors', []),
]);