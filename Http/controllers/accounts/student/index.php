<?php

use Models\User;
use Core\Session;

$user_id = auth_user()['id'];
$user = User::findByIdWithRoleData($user_id);

//dd($user);


view('/accounts/student/index.view.php', [
    'user' => $user,
    'errors' => Session::getFlash('errors', []),
]);