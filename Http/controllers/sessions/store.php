<?php

use Core\Authenticator;
use Http\Forms;


$form = Forms\Login::validate($attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
]);

$authenticator = new Authenticator;

$exists = $authenticator->checkExists($attributes['email']);
if (! $exists) {
    $form->error('email', "Account doesn't exist")
        ->throw();
}

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

$rejected = $authenticator->checkRejected($attributes['email']);

if ($rejected) {
    $form->error('email', "Account was rejected")
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
