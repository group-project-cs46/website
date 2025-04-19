<?php

use Models\User;
use Core\Session;

$user_id = auth_user()['id'];
$user = User::findByIdWithRoleData($user_id);


view('/accounts/company/index.view.php', [
    'user' => $user,
    'errors' => Session::getFlash('errors', []),
]);