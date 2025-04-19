<?php

use Http\Forms\ProfileDetails;
use Models\User;


$form = ProfileDetails::validate($attributes = [
    'bio' => $_POST['bio'],
    'linkedin' => $_POST['linkedin'],
    'mobile' => $_POST['mobile'],
]);

//dd($attributes);

User::update($attributes, auth_user()['id']);

redirect('/account');