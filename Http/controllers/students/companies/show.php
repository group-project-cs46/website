<?php

use Models\User;

$user = User::findByIdWithRoleData($_GET['id']);

//dd($user);

<<<<<<< HEAD
=======
//dd($user);

>>>>>>> 8b4d7493ee0f8e085c8141bffdabd5fb387be66c
view('students/companies/show.view.php', [
    'user' => $user,
    'heading' => 'jkj',
    'photo' => getUserProfilePhotoUrl($user)
]);