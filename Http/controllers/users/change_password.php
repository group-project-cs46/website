<?php

use Core\App;
use Core\Authenticator;
use Core\Database;
use Core\Session;
use Http\Forms\ChangePassword;

$db = App::resolve(Database::class);

$form = ChangePassword::validate($attributes = [
    'current_password' => $_POST['current_password'],
    'password' => $_POST['password'],
    'confirm_password' => $_POST['confirm_password'],
]);

if ($attributes['password'] !== $attributes['confirm_password']) {
    $form->error('password', 'Passwords do not match')
        ->throw();
}

//dd($attributes);

$user = auth_user();

if (! password_verify($attributes['current_password'], $user['password'])) {
    $form->error('current_password', "Credentials don't match")
        ->throw();
}



$db->query('UPDATE users SET password = ? WHERE id = ?', [
    password_hash($attributes['password'], PASSWORD_DEFAULT),
    $user['id']
]);

Session::flash('toast', 'Password updated successfully');

redirect('/account');

