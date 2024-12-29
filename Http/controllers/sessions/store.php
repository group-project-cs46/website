<?php

use Core\Authenticator;
use Http\Forms;


$form = Forms\Login::validate($attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
]);

$authenticator = new Authenticator;

$disabled = $authenticator->checkDisabled($attributes['email']);

if ($disabled) {
    $form->error('email', "Account is disabled")
        ->throw();
}

$approved = $authenticator->checkApproved($attributes['email']);

if (! $approved) {
    $form->error('email', "Account is not approved yet")
        ->throw();
}

$signedIn = $authenticator->attempt(
    $attributes['email'],
    $attributes['password']
);

if (! $signedIn) {
    $form->error('email', "Credentials don't match")
        ->throw();
}

redirect('/dashboard');
