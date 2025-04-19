<?php

use Models\User;

$user = User::findByIdWithRoleData($_GET['id']);

//dd($user);

//dd($user);

view('students/companies/show.view.php', [
    'user' => $user,
    'heading' => 'jkj',
    'photo' => getUserProfilePhotoUrl($user)
]);