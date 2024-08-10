<?php

use Core\Authenticator;
use Http\Forms;


$form = Forms\Login::validate($attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
]);


$signedIn = (new Authenticator)->attempt(
    $attributes['email'],
    $attributes['password']
);

if (! $signedIn) {
    $form->error('email', "Credentials don't match")
        ->throw();
}

redirect('/dashboard');
