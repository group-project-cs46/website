<?php

use Http\Forms\CompanyUpdate;
use Http\Forms\StudentUpdate;
use Models\Student;
use Models\User;


//dd($_POST);

$auth_user = auth_user();

$form = StudentUpdate::validate($attributes = [
    'mobile' => $_POST['mobile'],
    'bio' => $_POST['bio'],
    'linkedin' => $_POST['linkedin'],
    'website' => $_POST['website'],
]);

User::update([
    'mobile' => $attributes['mobile'],
    'bio' => $attributes['bio'],
    'linkedin' => $attributes['linkedin'],
], $auth_user['id']);

Student::update([
    'website' => $attributes['website'],
], $auth_user['id']);

redirect('/account');