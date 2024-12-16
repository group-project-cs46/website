<?php

use Core\App;
use Core\Database;
use Core\Session;
use Http\Forms\ResetPassword;

$db = App::resolve(Database::class);

$form = ResetPassword::validate($attributes = [
    'password' => $_POST['password'],
    'confirm_password' => $_POST['confirm_password'],
    'email' => $_POST['email'],
    'token' => $_POST['token'],
]);

if ($attributes['password'] !== $attributes['confirm_password']) {
    $form->error('password', 'Passwords do not match')
        ->throw();
}


$password_reset_record = $db->query('SELECT * FROM password_resets WHERE email = ?', [
    $attributes['email']
])->find();

//check expiry


if (strtotime($password_reset_record['expiry']) < time()) {
    $form->error('password', 'Link has expired')
        ->throw();
}

if ($password_reset_record['token'] !== $attributes['token']) {
    $form->error('password', 'Unauthorized')
        ->throw();
}

$db->query('UPDATE users SET password = ? WHERE email = ?', [
    password_hash($attributes['password'], PASSWORD_DEFAULT),
    $attributes['email']
]);

$db->query('DELETE FROM password_resets WHERE email = ?', [
    $attributes['email']
]);

Session::flash('toast', 'Password updated successfully');

redirect('/login');

redirect('/login');

